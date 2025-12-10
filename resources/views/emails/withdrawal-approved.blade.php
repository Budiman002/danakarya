@extends('emails.layout')

@section('title', 'Withdrawal Approved')

@section('content')
<h2>💰 Your Withdrawal Request Has Been Approved!</h2>

<p>Hello {{ $withdrawal->campaign->user->name }},</p>

<p>Great news! Your withdrawal request has been approved and processed.</p>

<div class="info-box">
    <p style="margin: 5px 0;"><strong>Campaign:</strong> {{ $withdrawal->campaign->title }}</p>
    <p style="margin: 5px 0;"><strong>Withdrawal Amount:</strong> Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</p>
    <p style="margin: 5px 0;"><strong>Bank Account:</strong> {{ $withdrawal->bank_name }} - {{ $withdrawal->account_number }}</p>
    <p style="margin: 5px 0;"><strong>Account Name:</strong> {{ $withdrawal->account_name }}</p>
    <p style="margin: 5px 0;"><strong>Request Date:</strong> {{ $withdrawal->created_at->format('d M Y') }}</p>
    <p style="margin: 5px 0;"><strong>Approval Date:</strong> {{ now()->format('d M Y') }}</p>
</div>

<p>The funds will be transferred to your bank account within <strong>1-3 business days</strong>.</p>

<p><strong>Important Notes:</strong></p>
<ul>
    <li>Please verify that the bank account details are correct</li>
    <li>If you don't receive the funds within 3 business days, please contact our support team</li>
    <li>Keep this email for your records</li>
</ul>

<a href="{{ url('/creator/campaigns') }}" class="button">View Dashboard</a>

<p>Thank you for using DanaKarya to bring your project to life!</p>

<p>Best regards,<br>The DanaKarya Team</p>
@endsection
