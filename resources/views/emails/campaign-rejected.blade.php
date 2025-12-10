@extends('emails.layout')

@section('title', 'Campaign Review Update')

@section('content')
<h2>📋 Campaign Review Update</h2>

<p>Hello {{ $campaign->user->name }},</p>

<p>Thank you for submitting your campaign <strong>{{ $campaign->title }}</strong> to DanaKarya.</p>

<p>After careful review, we're unable to approve your campaign at this time. Please don't be discouraged - we're here to help you improve!</p>

<div class="info-box">
    <p style="margin: 5px 0 10px 0;"><strong>Reason for rejection:</strong></p>
    <p style="margin: 5px 0;">{{ $reason }}</p>
</div>

<p><strong>What you can do next:</strong></p>
<ul>
    <li>Review and address the feedback provided above</li>
    <li>Update your campaign details in the creator dashboard</li>
    <li>Resubmit your campaign for review</li>
</ul>

<a href="{{ url('/creator/campaigns/' . $campaign->id . '/edit') }}" class="button">Edit Campaign</a>

<p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>

<p>We look forward to seeing your improved campaign!</p>

<p>Best regards,<br>The DanaKarya Team</p>
@endsection
