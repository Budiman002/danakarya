<?php

namespace App\Mail;

use App\Models\CampaignUpdate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CampaignUpdatePostedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public CampaignUpdate $update
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Update: ' . $this->update->campaign->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.campaign-update-posted',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
