<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Performance;
use Illuminate\Http\Request;
use App\Mail\PaymentSuccessful;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


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
                Log::error('Payment creation failed, no payment ID.');
                return back()->with('error', 'Failed to create payment. Please try again.');
            }
    
            $request->session()->put('paymentId', $payment->id);
    
            return redirect($payment->getCheckoutUrl());
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            Log::error("API call failed: " . $e->getMessage());
            return back()->with('error', 'Failed to create payment. Please try again.');
        }
    }

    public function handlePaymentStatus(Request $request)
    {
        $paymentId = $request->session()->get('paymentId');

        if (!$paymentId) {
            return redirect('shop.index')->with('error', 'Payment information not found.');
        }

        $payment = Mollie::api()->payments->get($paymentId);

        switch ($payment->status) {
            case 'paid':
                return $this->handlePaidStatus($request, $payment);
            case 'failed':
                return redirect()->route('performances.index')->with('error', 'De betaling is mislukt, probeer het opnieuw.');
            case 'canceled':
                return redirect()->route('performances.index')->with('error', 'De betaling is geannuleerd.');
            case 'expired':
                return redirect()->route('performances.index')->with('error', 'De betaling is verlopen.');
            default:
                return redirect()->route('performances.index')->with('error', 'Er is iets fout gegaan, probeer het opnieuw.');
        }

        $request->session()->forget('paymentId'); 

    }

    private function handlePaidStatus(Request $request, $payment)
    {
        $purchaseData = $request->session()->get('purchase_data', []);
        if (empty($purchaseData)) {
            return redirect()->route('performances.index')->with('error', 'No purchase data found.');
        }

        $performanceId = $payment->metadata->performanceId;
        $performance = Performance::findOrFail($performanceId);

        if ($performance->tickets_remaining < $purchaseData['amount']) {
            return back()->withErrors(['amount' => 'Not enough tickets available.']);
        }

        $ticket = new Ticket([
            'buyer_name' => $purchaseData['buyer_first_name'] . ' ' . $purchaseData['buyer_last_name'],
            'buyer_email' => $purchaseData['buyer_email'],
            'amount' => $purchaseData['amount'],
            'performance_id' => $performanceId,
            'unique_number' => mt_rand(1000, 9999),
        ]);

        $ticket->save();
        $email = $purchaseData['buyer_email'];
        $name = $purchaseData['buyer_first_name'];
        $performance->tickets_remaining -= $purchaseData['amount'];
        $performance->save();
        Mail::to($email)->send(new PaymentSuccessful($name));
        return redirect()->route('performances.show', $performanceId)->with('success', 'Ticket purchase successful!');
    }
}
