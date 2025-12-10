@extends('emails.layout')

@section('title', 'New Donation Received')

@section('content')
<h2>🎉 Great News! You Received a New Donation</h2>

<p>Hello {{ $donation->campaign->user->name }},</p>

<p>Congratulations! Your campaign <strong>{{ $donation->campaign->title }}</strong> has received a new donation.</p>

<div class="info-box">
    <p style="margin: 5px 0;"><strong>Donor:</strong> {{ $donation->user->name }}</p>
    <p style="margin: 5px 0;"><strong>Amount:</strong> Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
    <p style="margin: 5px 0;"><strong>Date:</strong> {{ $donation->created_at->format('d M Y, H:i') }}</p>
    @if($donation->message)
    <p style="margin: 15px 0 5px 0;"><strong>Message:</strong></p>
    <p style="margin: 5px 0; font-style: italic;">"{{ $donation->message }}"</p>
    @endif
</div>

<p>Your campaign has now raised <strong>Rp {{ number_format($donation->campaign->current_amount, 0, ',', '.') }}</strong> out of Rp {{ number_format($donation->campaign->target_amount, 0, ',', '.') }} goal!</p>

<a href="{{ url('/creator/campaigns/' . $donation->campaign->id) }}" class="button">View Campaign Dashboard</a>

<p>Keep up the great work and continue sharing your campaign to reach your goal!</p>

<p>Best regards,<br>The DanaKarya Team</p>
@endsection
