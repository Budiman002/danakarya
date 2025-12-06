@extends('layouts.creator')

@section('content')
<div class="mb-6">
    <div class="bg-gradient-to-r from-[#2D7A67] to-[#1A5647] text-white rounded-lg p-8 mb-6">
        <h2 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h2>
        <p class="text-gray-100">Manage your campaigns and track their progress</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">My Campaigns</p>
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
                    <p class="text-xl font-bold text-gray-900">Rp {{ number_format($totalRaised, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Backers</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalBackers }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Recent Campaigns</h2>
                <a href="{{ route('creator.campaigns.index') }}" class="text-[#2D7A67] hover:text-[#1A5647] font-semibold text-sm">
                    View All →
                </a>
            </div>

            @if($recentCampaigns->count() > 0)
                <div class="space-y-4">
                    @foreach($recentCampaigns as $campaign)
                        <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg hover:shadow-md transition">
                            @if($campaign->image)
                                <img src="{{ asset($campaign->image) }}" alt="{{ $campaign->title }}" class="w-20 h-20 object-cover rounded-lg">
                            @else
                                <div class="w-20 h-20 bg-gradient-to-br from-[#2D7A67] to-[#7DD3C0] rounded-lg flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">{{ substr($campaign->title, 0, 1) }}</span>
                                </div>
                            @endif

                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="font-bold text-gray-900">{{ $campaign->title }}</h3>
                                    @if($campaign->status === 'pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Pending</span>
                                    @elseif($campaign->status === 'active')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                                    @elseif($campaign->status === 'funded')
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Funded</span>
                                    @elseif($campaign->status === 'rejected')
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Rejected</span>
                                    @else
                                        <span class="px-2 py-1 bg-gray-200 text-gray-800 text-xs font-semibold rounded-full">Cancelled</span>
                                    @endif
                                </div>

                                @php
                                    $percentage = $campaign->target_amount > 0 ? min(($campaign->current_amount / $campaign->target_amount) * 100, 100) : 0;
                                @endphp

                                <div class="mb-2">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-[#2D7A67] h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>

                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Rp {{ number_format($campaign->current_amount, 0, ',', '.') }} raised</span>
                                    <span>{{ $campaign->donations_count }} backers</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No campaigns yet</h3>
                    <p class="text-gray-600 mb-4">Create your first campaign to start raising funds</p>
                    <a href="#" class="inline-block px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition">
                        Create Campaign (Coming Soon)
                    </a>
                </div>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h2>
            <div class="space-y-3">
                <a href="{{ route('creator.campaigns.index') }}" class="block p-4 border-2 border-gray-200 rounded-lg hover:border-[#2D7A67] transition">
                    <h3 class="font-semibold text-gray-900 mb-1">My Campaigns</h3>
                    <p class="text-sm text-gray-600">View and manage all campaigns</p>
                </a>
                <a href="{{ route('creator.campaigns.create') }}" class="block p-4 border-2 border-gray-200 rounded-lg hover:border-[#2D7A67] transition">
                <h3 class="font-semibold text-gray-900 mb-1">Create Campaign</h3>
                <p class="text-sm text-gray-600">Start a new fundraising campaign</p>
                </a>
                <a href="#" class="block p-4 border-2 border-gray-200 rounded-lg hover:border-[#2D7A67] transition opacity-50">
                    <h3 class="font-semibold text-gray-900 mb-1">Analytics</h3>
                    <p class="text-sm text-gray-600">View detailed campaign analytics</p>
                    <span class="text-xs text-gray-500 mt-1 block">Coming soon</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection