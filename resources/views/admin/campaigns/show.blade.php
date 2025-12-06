@extends('layouts.admin')

@section('content')
<div class="max-w-5xl">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.campaigns.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Campaigns
        </a>

        <div class="flex gap-2">
            <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                Edit Campaign
            </a>
            @if($campaign->status === 'pending')
                <form method="POST" action="{{ route('admin.campaigns.approve', $campaign->id) }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                        Approve
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.campaigns.reject', $campaign->id) }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition" onclick="return confirm('Reject this campaign?')">
                        Reject
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($campaign->image)
                    <img src="{{ asset($campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gradient-to-br from-[#2D7A67] to-[#7DD3C0] flex items-center justify-center">
                        <span class="text-white text-6xl font-bold">{{ substr($campaign->title, 0, 1) }}</span>
                    </div>
                @endif

                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $campaign->title }}</h1>
                        @if($campaign->status === 'pending')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full">Pending</span>
                        @elseif($campaign->status === 'active')
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">Active</span>
                        @elseif($campaign->status === 'funded')
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">Funded</span>
                        @elseif($campaign->status === 'rejected')
                            <span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-semibold rounded-full">Rejected</span>
                        @else
                            <span class="px-3 py-1 bg-gray-200 text-gray-800 text-sm font-semibold rounded-full">Cancelled</span>
                        @endif
                    </div>

                    <div class="prose max-w-none">
                        {!! nl2br(e($campaign->description)) !!}
                    </div>
                </div>
            </div>

            @if($campaign->donations->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Recent Backers ({{ $campaign->donations->count() }})</h2>
                    <div class="space-y-3">
                        @foreach($campaign->donations->take(10) as $donation)
                            <div class="flex items-center justify-between py-3 border-b border-gray-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-[#7DD3C0] rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold">{{ substr($donation->user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $donation->user->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $donation->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-600">{{ $donation->status }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Campaign Info</h2>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Creator</p>
                        <p class="font-semibold text-gray-900">{{ $campaign->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $campaign->user->email }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Category</p>
                        <p class="font-semibold text-gray-900">{{ $campaign->category->icon }} {{ $campaign->category->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Target Amount</p>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Raised</p>
                        <p class="text-2xl font-bold text-[#2D7A67]">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
                        @php
                            $percentage = $campaign->target_amount > 0 ? min(($campaign->current_amount / $campaign->target_amount) * 100, 100) : 0;
                        @endphp
                        <div class="mt-2">
                            <div class="w-full bg-gray-300 rounded-full h-2">
                                <div class="bg-[#2D7A67] h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ number_format($percentage, 0) }}% funded</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Backers</p>
                        <p class="text-xl font-bold text-gray-900">{{ $campaign->donations_count }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Deadline</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($campaign->deadline)->format('M d, Y') }}</p>
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($campaign->deadline)->diffForHumans() }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Created</p>
                        <p class="font-semibold text-gray-900">{{ $campaign->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h2>
                
                <div class="space-y-2">
                    <form method="POST" action="{{ route('admin.campaigns.destroy', $campaign->id) }}" onsubmit="return confirm('Delete this campaign? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-100 hover:bg-red-200 text-red-800 font-semibold rounded-lg transition" {{ $campaign->donations_count > 0 ? 'disabled' : '' }}>
                            Delete Campaign
                        </button>
                    </form>
                    @if($campaign->donations_count > 0)
                        <p class="text-xs text-gray-600 text-center">Cannot delete: has {{ $campaign->donations_count }} donations</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection