<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationMail;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use App\Models\Performance;
use App\Mail\PaymentSuccessful;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\Log;
use App\Models\PaymentInfo;
use Mollie\Api\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PDFController;

class DoneerController extends Controller
{


    public function index()
    {
        return view('donations.index');
    }

    public function submit(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'subject' => 'nullable',
            'message' => 'nullable',
            'type' => 'nullable',
            'date' => 'nullable|date',
            'state' => 'nullable'
        ]);

        $path = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->image->store('images', 'public');
        }

        // Prepare data for email
        $data = array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'type' => $request->get('type'),
            'date' => $request->get('date'),
            'user_message' => $request->get('message'),
            'state' => $request->get('state'),
            'image' => $path ?? null,
        );

        // Send the email with the uploaded image
        Mail::to(env('MAILTO', 'test@thover.eu'))->send(new DonationMail($data));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your donation has been submitted successfully!');
    }

    public function prepareDonation(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'donation_amount' => 'required|numeric|gt:0',
        ], [
            'donation_amount.required' => 'Het donatiebedrag is verplicht',
            'donation_amount.numeric' => 'Het donatiebedrag moet numeriek zijn',
            'donation_amount.gt' => 'Het donatiebedrag moet groter zijn dan 0',
        ]);

        $totalPrice = $validatedData['donation_amount'];

        try {
            // Create a payment with Mollie
            $payment = Mollie::api()->payments->create([
                'amount' => [
                    'currency' => 'EUR',
                    'value' => sprintf('%.2f', $totalPrice),
                ],
                'description' => 'Geld donatie',
                'redirectUrl' => route('donation.success', ['payment_id' => '{paymentId}']),
                'webhookUrl' => route('payment.webhook'),
                'method' => 'ideal',
            ]);

            // Update the redirect URL with the actual payment ID
            $payment->redirectUrl = route('donation.success', ['payment_id' => $payment->id]);
            $payment->update();

            // Save the payment info to the database
            PaymentInfo::create([
                'payment_id' => $payment->id,
                'data' => json_encode($validatedData),
                'status' => 'pending',
            ]);

            // Redirect to Mollie's checkout URL
            return redirect($payment->getCheckoutUrl());
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Mollie payment error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing the donation. Please try again. ');
        }
    }

    public function donationSuccess(Request $request)
    {
        $paymentId = $request->query('payment_id');

        if (!$paymentId) {
            return redirect()->route('donations.index')->with('error', 'Invalid payment ID.');
        }

        try {
            $payment = Mollie::api()->payments->get($paymentId);

            $dbPayment = PaymentInfo::where('payment_id', $payment->id)->first();
            if ($dbPayment) {
                $dbPayment->status = $payment->status;
                $dbPayment->save();
            }

            $statusMessage = '';

            switch ($payment->status) {
                case 'paid':
                    $statusMessage = 'Bedankt voor je donatie! Uw donatie is succesvol verwerkt.';
                    break;
                case 'open':
                    $statusMessage = 'Uw betaling is nog niet afgerond. Volg de instructies om de betaling te voltooien.';
                    break;
                case 'failed':
                    $statusMessage = 'Uw betaling is mislukt. Probeer het opnieuw of neem contact met ons op.';
                    break;
                case 'canceled':
                    $statusMessage = 'Uw betaling is geannuleerd. Probeer het opnieuw of neem contact met ons op.';
                    break;
                case 'expired':
                    $statusMessage = 'Uw betaling is verlopen. Probeer het opnieuw of neem contact met ons op.';
                    break;
                default:
                    $statusMessage = 'Er is een fout opgetreden bij het verwerken van uw betaling. Neem contact met ons op voor hulp.';
                    break;
            }

            return view('donations.success', ['statusMessage' => $statusMessage]);
        } catch (\Exception $e) {
            Log::error('Error retrieving payment: ' . $e->getMessage());
            return redirect()->route('donations.index')->with('error', 'An error occurred while retrieving the payment status.');
        }
    }
}
