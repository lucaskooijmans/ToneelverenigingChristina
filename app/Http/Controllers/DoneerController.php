<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationMail;
use Illuminate\Support\Facades\Storage;

class DoneerController extends Controller
{
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
    if($request->hasFile('image') && $request->file('image')->isValid()) {
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
    Mail::to('MAIL_FROM_ADDRESS')->send(new DonationMail($data));

    // Redirect back with success message
    return redirect()->back()->with('success', 'Your donation has been submitted successfully!');
}

}
