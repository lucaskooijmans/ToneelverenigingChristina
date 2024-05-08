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
        Log::info('Webhook called', ['id' => $request->input('id'), 'status' => $request->input('status')]);

        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);
        
        Log::info('Payment retrieved', ['paymentId' => $paymentId, 'status' => $payment->status]);

        $this->processPaymentStatus($payment);
    }

    public function confirmation()
    {
        return redirect()->route('performances.index')->with('success', 'Your payment process is complete. Please check your email for confirmation.');
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

    private function hasBeenProcessed($paymentId)
    {
        $exists = Ticket::where('payment_id', $paymentId)->exists();
        Log::info('Payment processed check', ['paymentId' => $paymentId, 'processed' => $exists]);
        return $exists;
    }

    private function handlePaidStatus($payment)
    {
        DB::transaction(function () use ($payment) {
            if (Ticket::where('payment_id', $payment->id)->exists()) {
                Log::warning('Duplicate payment processing attempted', ['paymentId' => $payment->id]);
                return;
            }

            $performanceId = $payment->metadata->performanceId;
            $performance = Performance::findOrFail($performanceId);
            $purchaseData = session()->get('purchase_data', []);

            if ($performance->tickets_remaining < $purchaseData['amount']) {
                Log::error("Not enough tickets available for performance {$performanceId}.");
                return;
            }

            $ticket = new Ticket([
                'buyer_name' => $purchaseData['buyer_first_name'] . ' ' . $purchaseData['buyer_last_name'],
                'buyer_email' => $purchaseData['buyer_email'],
                'amount' => $purchaseData['amount'],
                'performance_id' => $performanceId,
                'payment_id' => $payment->id, 
                'unique_number' => mt_rand(1000, 9999),
            ]);

            $ticket->save();
            $performance->tickets_remaining -= $purchaseData['amount'];
            $performance->save();

            // Generate PDF for the ticket
            $pdfPath = PDFController::createPDF(
                "$ticket->id.pdf",
                $performance->name,
                $ticket->buyer_name,
                $ticket->unique_number,
                ($performance->price * $ticket->amount),
                $ticket->amount,
                date('d/m/Y', strtotime($performance->starttime))
            );

            // Send email with the PDF ticket
            $email = new PaymentSuccessful($ticket->buyer_name, $ticket->id);
            $email->attach($pdfPath, [
                'as' => 'Ticket-' . $ticket->id . '.pdf',
                'mime' => 'application/pdf',
            ]);
            Mail::to($ticket->buyer_email)->send($email);

            Log::info("Payment for {$payment->id} processed successfully. Ticket ID: {$ticket->id}, Email sent with PDF.");
        });
    }
}
