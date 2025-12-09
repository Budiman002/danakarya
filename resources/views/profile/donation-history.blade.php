@extends('layouts.profile')

@section('content')
<div class="flex-1 p-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Donation History</h1>
        <p class="text-gray-600 mt-2">Track all your contributions to campaigns</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6">
            <p class="text-sm text-gray-600 mb-1">Total Donations</p>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['total_donations'] }}</p>
        </div>
        
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6">
            <p class="text-sm text-gray-600 mb-1">Total Amount</p>
            <p class="text-3xl font-bold text-green-600">Rp {{ number_format($stats['total_amount'], 0, ',', '.') }}</p>
        </div>
        
        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg p-6">
            <p class="text-sm text-gray-600 mb-1">Pending</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_count'] }}</p>
        </div>
    </div>

    @if($donations->isEmpty())
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No Donations Yet</h3>
            <p class="text-gray-600 mb-6">Start supporting campaigns and make a difference!</p>
            <a href="{{ route('campaigns.index') }}" class="inline-block px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition">
                Browse Campaigns
            </a>
        </div>
    @else
        <!-- Donations List -->
        <div class="space-y-4">
            @foreach($donations as $donation)
            <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Campaign Image -->
                    <div class="flex-shrink-0">
                        @if($donation->campaign->image)
                            <img src="{{ asset('images/campaigns/' . $donation->campaign->image) }}" alt="{{ $donation->campaign->title }}" class="w-24 h-24 object-cover rounded-lg">
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-gray-400 text-xs">No Image</span>
                            </div>
                        @endif
                    </div>

                    <!-- Campaign Info -->
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $donation->campaign->title }}</h3>
                                <p class="text-sm text-gray-600">by {{ $donation->campaign->user->name }}</p>
                            </div>
                            
                            <!-- Status Badge -->
                            @if($donation->status === 'confirmed')
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                                    ✓ Confirmed
                                </span>
                            @elseif($donation->status === 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">
                                    ⏱ Pending
                                </span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-semibold rounded-full">
                                    ✗ Failed
                                </span>
                            @endif
                        </div>

                        <!-- Donation Details -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 pt-4 border-t">
                            <div>
                                <p class="text-xs text-gray-500">Amount</p>
                                <p class="text-sm font-bold text-gray-900">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-xs text-gray-500">Date</p>
                                <p class="text-sm font-medium text-gray-900">{{ $donation->created_at->format('d M Y') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-xs text-gray-500">Payment Method</p>
                                <p class="text-sm font-medium text-gray-900 capitalize">{{ str_replace('_', ' ', $donation->payment_method) }}</p>
                            </div>
                            
                            <div>
                                <p class="text-xs text-gray-500">Transaction Code</p>
                                <p class="text-sm font-mono text-gray-900">{{ $donation->transaction_code }}</p>
                            </div>
                        </div>

                        @if($donation->message)
                        <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-500 mb-1">Your Message:</p>
                            <p class="text-sm text-gray-700 italic">"{{ $donation->message }}"</p>
                        </div>
                        @endif

                        <!-- Action Button -->
                        <div class="mt-4">
                            <a href="{{ route('campaigns.show', $donation->campaign->slug) }}" class="inline-block px-4 py-2 bg-[#2D7A67] hover:bg-[#1A5647] text-white text-sm font-semibold rounded-lg transition">
                                View Campaign
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection