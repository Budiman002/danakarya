@extends('emails.layout')

@section('title', 'Welcome to DanaKarya')

@section('content')
<h2>🎉 Welcome to DanaKarya!</h2>

<p>Hello {{ $user->name }},</p>

<p>Thank you for joining DanaKarya - Indonesia's trusted crowdfunding platform for MSMEs!</p>

<p>We're excited to have you as part of our community where dreams become reality through collective support.</p>

<div class="info-box">
    <h3 style="margin-top: 0; color: #2D7A67;">What You Can Do on DanaKarya:</h3>
    <ul style="margin: 10px 0; padding-left: 20px;">
        <li><strong>Support Campaigns:</strong> Discover and back amazing projects from Indonesian entrepreneurs</li>
        <li><strong>Create Campaigns:</strong> Launch your own fundraising campaign to grow your business</li>
        <li><strong>Track Progress:</strong> Follow campaigns you support and receive regular updates</li>
        <li><strong>Join Community:</strong> Connect with like-minded backers and creators</li>
    </ul>
</div>

<a href="{{ url('/campaigns') }}" class="button">Explore Campaigns</a>

<p><strong>Get Started:</strong></p>
<ul>
    <li>Complete your profile to personalize your experience</li>
    <li>Browse through active campaigns and find projects you love</li>
    <li>Have a business idea? Create your own campaign and start fundraising!</li>
</ul>

<p>If you have any questions, our support team is always here to help. Check out our <a href="{{ url('/how-it-works') }}" style="color: #2D7A67;">How It Works</a> page to learn more.</p>

<p>Let's make great things happen together!</p>

<p>Best regards,<br>The DanaKarya Team</p>
@endsection
