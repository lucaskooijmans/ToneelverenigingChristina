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
                "redirectUrl" => route('payment.handleStatus', ['status' => 'paid']), // Redirect with status 'paid'
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
                return redirect()->route('payment.handleStatus', ['status' => 'paid']); // Redirect with status 'paid'
            case 'open':
            case 'pending':
            case 'authorized':
            case 'expired':
            case 'canceled':
            case 'failed':
                return redirect()->route('payment.handleStatus', ['status' => $payment->status]); // Redirect with the respective status
            default:
                Log::warning('Received unhandled payment status', ['paymentId' => $payment->id, 'status' => $payment->status]);
                return redirect()->route('payment.handleStatus', ['status' => $payment->status]); // Redirect with the respective status
        }
    }

    private function handleOtherStatuses($payment)
    {
        Log::info('Non-payment status received', ['paymentId' => $payment->id, 'status' => $payment->status]);
        return redirect()->route('performances.index')->with('status', 'Payment status: ' . $payment->status);
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

    public function confirmation($status)
    {
        Log::info('confirmation called');

        switch ($status) {
            case 'paid':
                $message = 'Your payment process is complete. Please check your email for confirmation.';
                break;
            case 'open':
            case 'pending':
            case 'authorized':
                $message = 'Your payment is still being processed. Please check your email for updates.';
                break;
            case 'expired':
            case 'canceled':
            case 'failed':
                $message = 'Your payment failed. Please try again.';
                break;
            default:
                $message = 'Unknown payment status. Please contact support.';
                break;
        }

        return redirect()->route('performances.index')->with('success', $message);
    }
}
