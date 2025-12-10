<?php

namespace App\Mail;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CampaignApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Campaign $campaign
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Campaign Has Been Approved!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.campaign-approved',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
