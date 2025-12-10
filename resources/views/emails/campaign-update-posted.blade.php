@extends('emails.layout')

@section('title', 'New Campaign Update')

@section('content')
<h2>📢 New Update from {{ $update->campaign->user->name }}</h2>

<p>Hello Backer,</p>

<p>The campaign you supported, <strong>{{ $update->campaign->title }}</strong>, has just posted a new update!</p>

<div class="info-box">
    <h3 style="margin-top: 0; color: #2D7A67;">{{ $update->title }}</h3>
    <p style="margin: 10px 0; white-space: pre-line;">{{ \Str::limit($update->content, 300) }}</p>
    @if(strlen($update->content) > 300)
    <p style="margin: 5px 0;"><em>Read the full update on the campaign page...</em></p>
    @endif
</div>

<a href="{{ url('/campaigns/' . $update->campaign->slug) }}" class="button">Read Full Update</a>

<p>Stay connected with the campaigns you support and see the impact of your contribution!</p>

<p>Best regards,<br>The DanaKarya Team</p>
@endsection
