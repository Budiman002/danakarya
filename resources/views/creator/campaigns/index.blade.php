@extends('layouts.creator')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">My Campaigns</h2>
            <p class="text-sm text-gray-600 mt-1">Manage and track your campaigns</p>
        </div>
        <a href="{{ route('creator.campaigns.create') }}" class="px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition">
        + Create New Campaign
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <form method="GET" action="{{ route('creator.campaigns.index') }}" class="flex gap-4 flex-1">
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="funded" {{ request('status') == 'funded' ? 'selected' : '' }}>Funded</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>

                <div class="flex-1 relative">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search my campaigns..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent"
                    >
                </div>

                <button type="submit" class="px-6 py-2 bg-[#2D7A67] hover:bg-[#1A5647] text-white rounded-lg transition">
                    Search
                </button>
            </form>
        </div>

        @if($campaigns->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($campaigns as $campaign)
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                        @if($campaign->image)
                            <img src="{{ asset($campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-[#2D7A67] to-[#7DD3C0] flex items-center justify-center">
                                <span class="text-white text-4xl font-bold">{{ substr($campaign->title, 0, 1) }}</span>
                            </div>
                        @endif

                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs px-2 py-1 bg-gray-100 text-gray-600 rounded">{{ $campaign->category->icon }} {{ $campaign->category->name }}</span>
                                @if($campaign->status === 'pending')
                                    <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full font-semibold">Pending Review</span>
                                @elseif($campaign->status === 'active')
                                    <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full font-semibold">Active</span>
                                @elseif($campaign->status === 'funded')
                                    <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full font-semibold">Funded</span>
                                @elseif($campaign->status === 'rejected')
                                    <span class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded-full font-semibold">Rejected</span>
                                @else
                                    <span class="text-xs px-2 py-1 bg-gray-200 text-gray-800 rounded-full font-semibold">Cancelled</span>
                                @endif
                            </div>

                            <h3 class="font-bold text-gray-900 mb-3 line-clamp-2">{{ $campaign->title }}</h3>

                            @php
                                $percentage = $campaign->target_amount > 0 ? min(($campaign->current_amount / $campaign->target_amount) * 100, 100) : 0;
                            @endphp

                            <div class="mb-3">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-[#2D7A67] h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-600 mt-1">
                                    <span>{{ number_format($percentage, 0) }}% funded</span>
                                    <span>{{ \Carbon\Carbon::parse($campaign->deadline)->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="flex justify-between text-sm mb-3">
                                <div>
                                    <p class="font-bold text-gray-900">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-600">of Rp {{ number_format($campaign->target_amount / 1000000, 0) }}M</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">{{ $campaign->donations_count }}</p>
                                    <p class="text-xs text-gray-600">Backers</p>
                                </div>
                            </div>

                            @if($campaign->status === 'pending')
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-3">
                                    <p class="text-xs text-yellow-800">
                                        <span class="font-semibold">⏳ Awaiting Review</span><br>
                                        Your campaign is under review by our team
                                    </p>
                                </div>
                            @endif

                            @if($campaign->status === 'rejected')
                                <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-3">
                                    <p class="text-xs text-red-800">
                                        <span class="font-semibold">❌ Rejected</span><br>
                                        Please contact support for details
                                    </p>
                                </div>
                            @endif

                            <div class="flex gap-2">
                                <a href="{{ route('campaigns.show', $campaign->slug) }}" class="flex-1 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs text-center font-semibold rounded transition">
                                    View Public Page
                                </a>
                                @if($campaign->status !== 'rejected')
                                <a href="{{ route('creator.campaigns.edit', $campaign->id) }}" class="flex-1 px-3 py-2 bg-gray-600 hover:bg-gray-700 text-white text-xs text-center font-semibold rounded transition">
                                    Edit
                                </a>
                                @endif
                            </div>

                            @if($campaign->status === 'active')
                            <div class="mt-2">
                                <a href="{{ route('creator.campaigns.updates.index', $campaign) }}" class="block w-full px-3 py-2 bg-[#2D7A67] hover:bg-[#1A5647] text-white text-xs text-center font-semibold rounded transition">
                                    📝 Manage Updates ({{ $campaign->updates_count ?? 0 }})
                                </a>
                            </div>
                            @endif

                            @if($campaign->status === 'funded' && $campaign->current_amount >= $campaign->target_amount)
                                @php
                                    $hasPendingWithdrawal = \App\Models\Disbursement::where('campaign_id', $campaign->id)
                                        ->where('status', 'pending')
                                        ->exists();
                                @endphp
                                <div class="mt-2">
                                    @if($hasPendingWithdrawal)
                                        <button class="block w-full px-3 py-2 bg-gray-400 text-white text-xs text-center font-semibold rounded cursor-not-allowed" disabled>
                                            ⏳ Withdrawal Pending
                                        </button>
                                    @else
                                        <a href="{{ route('creator.disbursements.create', $campaign->id) }}" class="block w-full px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs text-center font-semibold rounded transition">
                                            💰 Request Withdrawal
                                        </a>
                                    @endif
                                </div>
                            @endif

                            <div class="mt-2 text-center">
                                <p class="text-xs text-gray-500">Created {{ $campaign->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $campaigns->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No campaigns yet</h3>
                <p class="text-gray-600 mb-6">Start your fundraising journey by creating your first campaign</p>
                <a href="{{ route('creator.campaigns.create') }}" class="inline-block px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition">
                Create Your First Campaign
                </a>
            </div>
        @endif
    </div>
</div>
@endsection