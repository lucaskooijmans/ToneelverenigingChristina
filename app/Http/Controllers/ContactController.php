<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $data = array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'user_message' => $request->get('message'),
        );
        
    
        Mail::send('emails.contact', ['data' => $data], function($message) use ($data) {
            $message->to(config('mail.from.address'))->subject('Contact Form Submission');
            $message->from($data['email']);
        });   
        
        session()->flash('success', 'Bedankt voor uw bericht! U ontvangt een bevestigingsmail.');

        Mail::send('emails.confirmation', ['data' => $data], function($message) use ($data) {
            $message->to($data['email'])->subject('Bevestiging van contactformulierinzending');
            $message->from(config('mail.from.address'));
        });
        
        return redirect()->back();
    }
}
