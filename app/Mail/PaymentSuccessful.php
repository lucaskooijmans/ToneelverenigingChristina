<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class PaymentSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $id;
    /**
     * Create a new message instance.
     */
    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
        $this->attach(public_path('images/LogoSmall.jpg'), [
            'as' => 'logo.jpg',
            'mime' => 'image/jpeg',
        ]);
        $this->attach(Storage::path($id . '.pdf'), [
            'as' => 'ticket.pdf',
            'mime' => 'application/pdf',
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Successful',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.paymentsuccessmail',
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

        return [
            
        ];
    }
}
