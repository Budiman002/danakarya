@extends('layouts.public')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Success Header -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 p-8 text-center text-white">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold mb-2">Thank You!</h1>
                <p class="text-green-100">Your donation has been received</p>
            </div>

            <!-- Donation Details -->
            <div class="p-6 space-y-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Donation Details</h2>
                    
                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Donation ID</span>
                            <span class="font-semibold text-gray-900">#{{ $donation->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Amount</span>
                            <span class="font-bold text-[#2D7A67] text-xl">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">
                                {{ ucfirst($donation->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date</span>
                            <span class="font-semibold text-gray-900">{{ $donation->created_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h3 class="font-semibold text-gray-900 mb-2">Campaign Supported</h3>
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                        @if($donation->campaign->image)
                            <img src="{{ asset($donation->campaign->image) }}" alt="{{ $donation->campaign->title }}" class="w-20 h-20 object-cover rounded-lg">
                        @endif
                        <div>
                            <p class="font-semibold text-gray-900">{{ $donation->campaign->title }}</p>
                            <p class="text-sm text-gray-600">by {{ $donation->campaign->user->name }}</p>
                        </div>
                    </div>
                </div>

                @if($donation->message)
                <div class="border-t pt-6">
                    <h3 class="font-semibold text-gray-900 mb-2">Your Message</h3>
                    <p class="text-gray-700 bg-gray-50 rounded-lg p-4">{{ $donation->message }}</p>
                </div>
                @endif

                <div class="border-t pt-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <p class="text-sm text-blue-800">
                            <strong>What's Next?</strong><br>
                            Your payment is being processed. Once confirmed, your donation will be added to the campaign and you'll appear in the backers list. You'll receive a confirmation email shortly.
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <a href="{{ route('campaigns.show', $donation->campaign->slug) }}" class="flex-1 px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white text-center font-semibold rounded-lg transition">
                        View Campaign
                    </a>
                    <a href="{{ route('campaigns.index') }}" class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 text-center font-semibold rounded-lg transition">
                        Browse Campaigns
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection