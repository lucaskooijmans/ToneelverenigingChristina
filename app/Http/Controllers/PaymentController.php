<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Performance;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccessful;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\PaymentInfo;
use Mollie\Api\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PDFController;

class PaymentController extends Controller
{
    public function preparePayment(Request $request, $id)
    {
        Log::info('preparePayment called', ['performanceId' => $id]);
        $validatedData = $request->validate([
            'buyer_first_name' => 'required|max:255',
            'buyer_last_name' => 'required|max:255',
            'buyer_email' => 'required|email|max:255',
            'amount' => 'required|integer|gt:0',
        ], [
            'buyer_first_name.required' => 'Voornaam is verplicht',
            'buyer_last_name.required' => 'Achternaam is verplicht',
            'buyer_email.required' => 'E-mailadres is verplicht',
            'buyer_email.email' => 'Ongeldig e-mailadres',
            'amount.required' => 'Aantal tickets is verplicht',
            'amount.integer' => 'Aantal tickets moet een getal zijn',
            'amount.gt' => 'Aantal tickets moet groter zijn dan 0',
        ]);
    
        $performance = Performance::findOrFail($id);
        $totalPrice = $performance->price * $validatedData['amount'];
    
        try {
            $payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    'value' => sprintf("%.2f", $totalPrice)
                ],
                "description" => "Tickets for " . $performance->name,
                "redirectUrl" => route('payment.status', ['id' => uniqid()]), // Temporary unique ID
                "webhookUrl" => route('payment.webhook'),
                "method" => "ideal",
                "metadata" => [
                    "performanceId" => $id 
                ],
            ]);
    
            if (!isset($payment) || !isset($payment->id)) {
                Log::error('Payment creation failed', ['performanceId' => $id, 'validatedData' => $validatedData]);
                return back()->with('error', 'Failed to create payment. Please try again');
            }
    
            // Update redirectUrl with the correct payment ID
            $payment->redirectUrl = route('payment.status', ['id' => $payment->id]);
            $payment->update();
    
            PaymentInfo::create([
                'payment_id' => $payment->id,
                'performance_id' => $id,
                'data' => json_encode($validatedData)
            ]);
    
            return redirect($payment->getCheckoutUrl());
        } catch (ApiException $e) {
            Log::error("API call failed during payment creation", ['error' => $e->getMessage(), 'performanceId' => $id, 'validatedData' => $validatedData]);
            return back()->with('error', 'Failed to create payment. Please try again.');
        } catch (\Exception $e) {
            Log::error("Unexpected error during payment creation", ['error' => $e->getMessage(), 'performanceId' => $id, 'validatedData' => $validatedData]);
            return back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }
        
    public function handleWebhook(Request $request)
    {
        try {
            Log::info('Webhook called', ['id' => $request->input('id'), 'status' => $request->input('status')]);
    
            $paymentId = $request->input('id');
            $payment = Mollie::api()->payments->get($paymentId);
    
            Log::info('Payment retrieved', ['payment' => $payment]);
    
            // Save payment status
            $paymentInfo = PaymentInfo::where('payment_id', $paymentId)->first();
            if ($paymentInfo) {
                $paymentInfo->status = $payment->status;
                $paymentInfo->save();
                Log::info('Payment status updated', ['paymentId' => $paymentId, 'status' => $payment->status]);
            } else {
                Log::error('PaymentInfo not found for paymentId', ['paymentId' => $paymentId]);
            }
    
            $this->processPaymentStatus($payment);
    
            return response()->json(['status' => 'received']);
        } catch (\Exception $e) {
            Log::error('Webhook handling failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Webhook handling failed', 'message' => $e->getMessage()], 500);
        }
    }
    
    private function processPaymentStatus($payment)
    {
        Log::info('Processing payment status', ['paymentId' => $payment->id, 'status' => $payment->status]);
    
        switch ($payment->status) {
            case 'paid':
                if (!$this->hasBeenProcessed($payment->id)) {
                    $this->handlePaidStatus($payment);
                }
                break;
            case 'open':
            case 'expired':
            case 'canceled':
            case 'failed':
                $this->handleOtherStatuses($payment);
                break;
            default:
                Log::warning('Received unhandled payment status', ['paymentId' => $payment->id, 'status' => $payment->status]);
                $this->handleOtherStatuses($payment);
                break;
        }
    }    

    private function handleOtherStatuses($payment)
    {
        Log::info('Non-payment status received', ['paymentId' => $payment->id, 'status' => $payment->status]);
    
        // Save the status to the PaymentInfo record
        $paymentInfo = PaymentInfo::where('payment_id', $payment->id)->first();
        if ($paymentInfo) {
            Log::info('Status in handleOtherStatuses = ', $payment->status);
            $paymentInfo->status = $payment->status;
            $paymentInfo->save();
            Log::info('Payment status updated', ['paymentId' => $payment->id, 'status' => $payment->status]);
        } else {
            Log::error('PaymentInfo not found for paymentId', ['paymentId' => $payment->id]);
        }
    
        return redirect()->route('payment.status', ['id' => $payment->id]);
    }
    
    private function hasBeenProcessed($uniqueNumber)
    {
        Log::info('Checking if payment has been processed', ['uniqueNumber' => $uniqueNumber]);
        $exists = Ticket::where('unique_number', $uniqueNumber)->exists();
        Log::info('Payment processed check', ['uniqueNumber' => $uniqueNumber, 'processed' => $exists]);
        return $exists;
    }

    private function handlePaidStatus($payment)
    {
        Log::info('handlePaidStatus called');

        $paymentInfo = PaymentInfo::where('payment_id', $payment->id)->first();

        if (!$paymentInfo || empty($paymentInfo->data)) {
            Log::error("Purchase data missing or not specified.");
            return redirect()->route('performances.index')->with('error', 'Betaling informatie niet gevonden, probeer het opnieuw.');
        }

        $purchaseData = json_decode($paymentInfo->data, true);

        $performanceId = $payment->metadata->performanceId;
        $performance = Performance::findOrFail($performanceId);

        if ($performance->tickets_remaining < $purchaseData['amount']) {
            Log::error("Not enough tickets available for performance {$performanceId}.");
            return back()->withErrors(['amount' => 'Er zijn niet genoeg tickets beschikbaar. Probeer het opnieuw.']);
        }

        $ticket = new Ticket([
            'buyer_name' => $purchaseData['buyer_first_name'] . ' ' . $purchaseData['buyer_last_name'],
            'buyer_email' => $purchaseData['buyer_email'],
            'amount' => $purchaseData['amount'],
            'performance_id' => $performanceId,
            'unique_number' => mt_rand(1000, 9999),
        ]);

        $ticket->save();
        $performance->tickets_remaining -= $purchaseData['amount'];
        $performance->save();

        // Generate PDF and send email
        $pdfPath = PDFController::createPDF(
            "$ticket->id.pdf",
            $performance->name,
            $ticket->buyer_name,
            $ticket->unique_number,
            ($performance->price * $purchaseData['amount']),
            $purchaseData['amount'],
            date('d/m/Y', strtotime($performance->starttime))
        );

        Mail::to($purchaseData['buyer_email'])->send(new PaymentSuccessful($purchaseData['buyer_first_name'], $ticket->id, $pdfPath));

        Log::info("Payment for {$payment->id} processed successfully. Ticket ID: {$ticket->id}, Email sent with PDF.");

        return redirect()->route('performances.show', $performanceId)->with('success', 'Betaling succesvol afgerond. Uw tickets zijn verzonden naar uw e-mailadres.');
    }

    public function confirmation($id)
    {

        Log::info('confirmation called', ['paymentId' => $id]);
    
        $paymentInfo = PaymentInfo::where('payment_id', $id)->first();
    
        if (!$paymentInfo) {
            Log::error('PaymentInfo not found for paymentId', ['paymentId' => $id]);
            return redirect()->route('performances.index')->with('error', 'Betalingsinformatie niet gevonden.');
        }
    
        Log::info('PaymentInfo found', ['paymentId' => $id, 'status' => $paymentInfo->status]);
    
        switch ($paymentInfo->status) {
            case 'paid':
                $message = 'Uw betaling is voltooid. Controleer uw e-mail voor de bevestiging.';
                break;
            case 'open':
                $message = 'Uw betaling wordt nog verwerkt. Controleer uw e-mail voor updates.';
                break;
            case 'expired':
            case 'canceled':
            case 'failed':
                $message = 'Uw betaling is mislukt. Probeer het opnieuw.';
                break;
            default:
                $message = 'Onbekende betalingsstatus. Neem contact op met de ondersteuning.';
                break;
        }
    
        return redirect()->route('performances.index')->with('success', $message);
    }    
}
