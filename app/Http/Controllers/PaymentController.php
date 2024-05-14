<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Performance;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccessful;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
            'amount' => 'required|integer|min:1',
        ]);

        $request->session()->put('purchase_data', $validatedData);

        $performance = Performance::findOrFail($id);
        $totalPrice = $performance->price * $validatedData['amount'];

        try {
            $payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    'value' => sprintf("%.2f", $totalPrice)
                ],
                "description" => "Tickets for " . $performance->name,
                "redirectUrl" => route('payment.handleStatus'),
                "webhookUrl" => route('payment.webhook'),
                "method" => "ideal",
                "metadata" => [
                    "performanceId" => $id 
                ],
            ]);

            if (!isset($payment) || !isset($payment->id)) {
                return back()->with('error', 'Failed to create payment. Please try again');
            }

            $request->session()->put('paymentId', $payment->id);

            return redirect($payment->getCheckoutUrl());
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            Log::error("API call failed: " . $e->getMessage());
            return back()->with('error', 'Failed to create payment. Please try again.');
        }
    }

    public function handleWebhook(Request $request)
    {
        try {
            Log::info('Webhook called', ['id' => $request->input('id'), 'status' => $request->input('status')]);

            $paymentId = $request->input('id');
            $payment = Mollie::api()->payments->get($paymentId);

            // Log the payment object retrieved from Mollie
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
                break;
            case 'open':
            case 'pending':
            case 'authorized':
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
        Log::info('Redirecting due to non-payment status', ['paymentId' => $payment->id, 'status' => $payment->status]);
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

        // Fetching purchase data from session
        $purchaseData = session()->get('purchase_data', []);
        // Check if purchase data is available and contains necessary 'amount' key
        if (empty($purchaseData) || !isset($purchaseData['amount'])) {
            Log::error("Purchase data missing or amount not specified.");
            return redirect()->route('performances.index')->with('error', 'Betaling informatie niet gevonden, probeer het opnieuw.');
        }

        $performanceId = $payment->metadata->performanceId;
        $performance = Performance::findOrFail($performanceId);

        // Check if enough tickets are available
        if ($performance->tickets_remaining < $purchaseData['amount']) {
            Log::error("Not enough tickets available for performance {$performanceId}.");
            return back()->withErrors(['amount' => 'Er zijn niet genoeg tickets beschikbaar. Probeer het opnieuw.']);
        }

        // Proceed to create ticket
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



    public function confirmation()
    {
        Log::info('confirmation called');
        return redirect()->route('performances.index')->with('success', 'Your payment process is complete. Please check your email for confirmation.');
    }

}
