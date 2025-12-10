@extends('emails.layout')

@section('title', 'Campaign Approved')

@section('content')
<h2>✅ Your Campaign Has Been Approved!</h2>

<p>Hello {{ $campaign->user->name }},</p>

<p>We're excited to inform you that your campaign <strong>{{ $campaign->title }}</strong> has been reviewed and approved!</p>

<div class="info-box">
    <p style="margin: 5px 0;"><strong>Campaign:</strong> {{ $campaign->title }}</p>
    <p style="margin: 5px 0;"><strong>Target Amount:</strong> Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
    <p style="margin: 5px 0;"><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($campaign->deadline)->format('d M Y') }}</p>
    <p style="margin: 5px 0;"><strong>Status:</strong> <span style="color: #28a745;">Active</span></p>
</div>

<p>Your campaign is now live and visible to all backers on DanaKarya! Start sharing your campaign to reach your funding goal.</p>

<a href="{{ url('/campaigns/' . $campaign->slug) }}" class="button">View Live Campaign</a>

<p><strong>Next Steps:</strong></p>
<ul>
    <li>Share your campaign on social media</li>
    <li>Update your backers regularly about your progress</li>
    <li>Engage with your supporters in the comments</li>
    <li>Post campaign updates to keep backers informed</li>
</ul>

<p>Good luck with your fundraising journey!</p>

<p>Best regards,<br>The DanaKarya Team</p>
@endsection
