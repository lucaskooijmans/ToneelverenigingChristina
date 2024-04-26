<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Ticket;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


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
                "description" => "Tickets voor " . $performance->name,
                "redirectUrl" => route('payment.success', ['performanceId' => $id]), 
                "webhookUrl" => route('payment.webhook'),
                "method" => "ideal",
            ]);

            return redirect($payment->getCheckoutUrl());
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            Log::error("API call failed: " . $e->getMessage());
            return back()->with('error', 'Failed to create payment. Please try again.');
        }
    }

    public function paymentSuccess(Request $request, $performanceId)
    {
        $purchaseData = $request->session()->get('purchase_data', []);

        if (empty($purchaseData)) {
            return redirect()->route('performances.index')->with('error', 'Payment was successful but purchase data is missing.');
        }
        
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

        $performance->tickets_remaining -= $purchaseData['amount'];
        $performance->tickets_sold += $purchaseData['amount'];
        $performance->save();

        // TODO: Redirect naar view purchase gelukt
        return redirect()->route('performances.show', $performanceId)->with('success', 'Ticket purchase successful!');
    }

    public function handleWebhook()
    {
        $paymentid = request('id');
        $payment = Mollie::api()->payments->get($paymentid);

        if ($payment->isPaid()) {
            echo 'Payment received';
        }

        return response('Webhook received', 200);
    }

    public function paymentFailed()
    {
        return redirect()->route('performances.index')->with('error', 'Payment failed. Please try again.');
    }
}
