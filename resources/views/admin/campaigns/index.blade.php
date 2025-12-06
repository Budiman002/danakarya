@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Campaigns</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalCampaigns }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Pending Approval</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $pendingCampaigns }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Active Campaigns</p>
                    <p class="text-2xl font-bold text-green-600">{{ $activeCampaigns }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Raised</p>
                    <p class="text-lg font-bold text-gray-900">Rp {{ number_format($totalRaised, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <form method="GET" action="{{ route('admin.campaigns.index') }}" class="flex gap-4 flex-1">
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
                        placeholder="Search by title or creator..."
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
                                    <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full font-semibold">Pending</span>
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

                            <h3 class="font-bold text-gray-900 mb-1 line-clamp-2">{{ $campaign->title }}</h3>
                            <p class="text-sm text-gray-600 mb-3">By {{ $campaign->user->name }}</p>

                            @php
                                $percentage = $campaign->target_amount > 0 ? min(($campaign->current_amount / $campaign->target_amount) * 100, 100) : 0;
                            @endphp

                            <div class="mb-3">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-[#2D7A67] h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-600 mt-1">
                                    <span>{{ number_format($percentage, 0) }}%</span>
                                    <span>{{ \Carbon\Carbon::parse($campaign->deadline)->format('M d, Y') }}</span>
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

                            <div class="flex gap-2">
                                @if($campaign->status === 'pending')
                                    <form method="POST" action="{{ route('admin.campaigns.approve', $campaign->id) }}" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs rounded transition">
                                            Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.campaigns.reject', $campaign->id) }}" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs rounded transition" onclick="return confirm('Reject this campaign?')">
                                            Reject
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.campaigns.show', $campaign->id) }}" class="flex-1 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded text-center transition">
                                        View
                                    </a>
                                    <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="flex-1 px-3 py-1.5 bg-gray-600 hover:bg-gray-700 text-white text-xs rounded text-center transition">
                                        Edit
                                    </a>
                                @endif
                            </div>

                            @if($campaign->donations_count > 0)
                                <p class="text-xs text-gray-500 mt-2 text-center">{{ $campaign->donations_count }} donations</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $campaigns->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No campaigns found</h3>
                <p class="text-gray-600">Try adjusting your filters</p>
            </div>
        @endif
    </div>
</div>
@endsection