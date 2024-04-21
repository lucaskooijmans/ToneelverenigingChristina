<?php

namespace App\Http\Controllers;

use Mollie\Laravel\Facades\Mollie;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function preparePayment($id)
    {
        $products = [
           1 => ['name' => 'Product 1', 'price' => 100],
           2 => ['name' => 'Product 2', 'price' => 200],
           3 => ['name' => 'Product 3', 'price' => 300],
           4 => ['name' => 'Product 4', 'price' => 400],
           5 => ['name' => 'Product 5', 'price' => 500],
        ];

        $product = $products[$id];
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                'value' => sprintf("%.2f", $product['price']) // Ensure two decimal places
            ],
            "description" => $product['name'],
            "redirectUrl" => route('payment.success'),
            "webhookUrl" => route('payment.webhook'),
            "method" => "ideal",
        ]);

        return redirect($payment->getCheckoutUrl());
    }

    public function paymentSuccess()
    {
        return view('payment.success', ['message' => 'Payment was successful!']);
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
}
