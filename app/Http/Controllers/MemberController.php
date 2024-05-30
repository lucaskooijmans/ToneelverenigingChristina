<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function index(){
        return view('member.register');
    }

    public function store(Request $request)
    {
        Log::info('Starting member registration process.');

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members',
            'phoneNumber' => 'min:10',
            'postalCode' => 'required|min:6|max:7', // dit nog veranderen naar regex
            'houseNumber' => 'required',
            'street' => 'required',
            'city' => 'required'
        ]);

        Log::info('Validation passed.');

        $member = Member::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phoneNumber' => $validatedData['phoneNumber'],
            'postalCode' => $validatedData['postalCode'],
            'houseNumber' => $validatedData['houseNumber'],
            'street' => $validatedData['street'],
            'city' => $validatedData['city']
        ]);

        Log::info('Member created successfully with ID: ' . $member->id);

        $data = [
            'name' => $member->name,
            'email' => $member->email,
            'phoneNumber' => $member->phoneNumber
        ];

        // Stuur een e-mail naar de MAIL_FROM_ADDRESS met de alert template
        Mail::send('emails.member-registration-alert', ['data' => $data], function($message) use ($data) {
            $message->to(config('mail.from.address'))->subject('Nieuwe inschrijving');
            $message->from(config('mail.from.address'));
        });

        Log::info('Registration alert email sent.');

        // Stuur een bevestigingsmail naar het lid met de confirmation template
        Mail::send('emails.member-registration-confirmation', ['data' => $data], function($message) use ($data) {
            $message->to($data['email'])->subject('Inschrijving bij Toneelvereniging Christina succesvol');
            $message->from(config('mail.from.address'));
        });

        Log::info('Confirmation email sent to: ' . $data['email']);

        if ($request->has('pay')) {
            Log::info('Payment option selected.');
            return $this->processPayment($member);
        }

        session()->flash('success', 'Bedankt voor de inschrijving! U ontvangt zo snel mogelijk een bevestigingsmail.');
        Log::info('Registration process completed without payment.');

        return redirect()->back();
    }

    protected function processPayment($member)
    {
        try {
            Log::info('Starting payment process for member ID: ' . $member->id);

            // Create a payment with Mollie
            $payment = Mollie::api()->payments->create([
                'amount' => [
                    'currency' => 'EUR',
                    'value' => '10.00',
                ],
                'description' => 'Lidmaatschap Toneelvereniging Christina',
                'redirectUrl' => route('member.paymentSuccess', ['id' => $member->id]),
                'webhookUrl' => route('payment.webhook'),
                'metadata' => [
                    'member_id' => $member->id,
                ],
            ]);

            // Save the payment ID
            $member->mollie_payment_id = $payment->id;
            $member->save();

            // Log the redirect URL for debugging
            Log::info('Mollie payment URL: ' . $payment->getCheckoutUrl());

            // Redirect to Mollie's payment page
            return redirect($payment->getCheckoutUrl());
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Mollie payment error: ' . $e->getMessage());
            return redirect()->route('member.register')->with('error', 'Er is een fout opgetreden tijdens het verwerken van de betaling. Probeer het opnieuw.');
        }
    }

    public function paymentSuccess($id)
    {
        Log::info('Payment success callback for member ID: ' . $id);

        $member = Member::findOrFail($id);
        $payment = Mollie::api()->payments->get($member->mollie_payment_id);

        if ($payment->isPaid()) {
            Log::info('Payment is confirmed as paid for member ID: ' . $id);

            $member->payment_status = 'paid';
            $member->save();

            session()->flash('success', 'Bedankt voor uw betaling! Uw inschrijving is voltooid.');
        } else {
            Log::warning('Payment not successful for member ID: ' . $id);
            session()->flash('error', 'Betaling is niet gelukt. Probeer het opnieuw.');
        }

        return redirect()->route('member.register');
    }

    public function webhook(Request $request)
    {
        Log::info('Webhook received from Mollie.');

        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);

        if ($payment->isPaid()) {
            Log::info('Payment confirmed via webhook for payment ID: ' . $paymentId);

            $member = Member::where('mollie_payment_id', $paymentId)->first();
            if ($member) {
                $member->payment_status = 'paid';
                $member->save();
            }
        } else {
            Log::warning('Payment not successful via webhook for payment ID: ' . $paymentId);
        }
    }

    public function adminIndex() {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    public function create() {
        return view('members.create');
    }

    public function edit(Member $member) {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member) {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'phoneNumber' => 'min:10',
            'postalCode' => 'required|min:6|max:7',
            'houseNumber' => 'required',
            'street' => 'required',
            'city' => 'required'
        ]);

        $member->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phoneNumber' => $validatedData['phoneNumber'],
            'postalCode' => $validatedData['postalCode'],
            'houseNumber' => $validatedData['houseNumber'],
            'street' => $validatedData['street'],
            'city' => $validatedData['city']
        ]);

        return redirect()->route('members.index')->with('success', 'Lid bijgewerkt.');
    }

    public function destroy(Member $member) {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Lid verwijderd.');
    }

    public function setIsActive(Member $member)
    {
        $member->update(['isActive' => true]);
        return redirect()->route('members.index')->with('success', 'Lid op actief gezet.');
    }

    public function removeIsActive(Member $member)
    {
        $member->update(['isActive' => false]);
        return redirect()->route('members.index')->with('success', 'Lid op inactief gezet.');
    }
}
