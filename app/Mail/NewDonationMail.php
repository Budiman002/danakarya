<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewDonationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Donation $donation
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Donation Received - ' . $this->donation->campaign->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-donation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
