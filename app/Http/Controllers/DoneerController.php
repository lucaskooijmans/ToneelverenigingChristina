<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationMail;
use Illuminate\Support\Facades\Storage;

class DoneerController extends Controller
{
    public function submit(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $data = array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'image' => $imagePath,
            'type' => $request->get('type'),
            'date' => $request->get('date'),
            'user_message' => $request->get('message'),
            'state' => $request->get('state'),
        );
        

        Mail::to(config('mail.from.address'))->send(new DonationMail($data));

        return back()->with('success', 'Email sent successfully!');
    }
}
