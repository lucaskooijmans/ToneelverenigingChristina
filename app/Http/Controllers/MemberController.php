<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members',
            'password' => 'required',
        ]);

        $member = Member::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $data = [
            'name' => $member->name,
            'email' => $member->email,
        ];

        // Stuur een e-mail naar de MAIL_FROM_ADDRESS met de alert template
        Mail::send('emails.member-registration-alert', ['data' => $data], function($message) use ($data) {
            $message->to(config('mail.from.address'))->subject('Nieuwe inschrijving');
            $message->from(config('mail.from.address'));
        });

        // Stuur een bevestigingsmail naar het lid met de confirmation template
        Mail::send('emails.member-registration-confirmation', ['data' => $data], function($message) use ($data) {
            $message->to($data['email'])->subject('Inschrijving bij Toneelvereniging Christina succesvol');
            $message->from(config('mail.from.address'));
        });

        session()->flash('success', 'Bedankt voor de inschrijving! U ontvangt een bevestigingsmail.');

        return redirect()->back();
    }

}
