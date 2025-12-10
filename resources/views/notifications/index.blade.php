@php
    $user = Auth::user();
    $layout = 'layouts.profile';

    if ($user->isAdmin()) {
        $layout = 'layouts.admin';
    } elseif ($user->isCreator()) {
        $layout = 'layouts.creator';
    }
@endphp

@extends($layout)

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">{{ __('Notifications') }}</h1>
            @if($unreadCount > 0)
            <form action="{{ route('notifications.read-all') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-[#2D7A67] hover:bg-[#1A5647] text-white text-sm rounded-lg transition">
                    {{ __('Mark all as read') }}
                </button>
            </form>
            @endif
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($notifications->count() > 0)
            <div class="bg-white rounded-lg shadow-md divide-y divide-gray-200">
                @foreach($notifications as $notification)
                    <div class="p-4 hover:bg-gray-50 transition {{ $notification->is_read ? 'opacity-75' : '' }}">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                @if($notification->type === 'welcome')
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-2xl">🎉</span>
                                    </div>
                                @elseif($notification->type === 'new_donation')
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="text-2xl">💰</span>
                                    </div>
                                @elseif($notification->type === 'donation_success')
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="text-2xl">✅</span>
                                    </div>
                                @elseif($notification->type === 'campaign_approved')
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="text-2xl">✅</span>
                                    </div>
                                @elseif($notification->type === 'campaign_rejected')
                                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                        <span class="text-2xl">❌</span>
                                    </div>
                                @elseif($notification->type === 'campaign_update')
                                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                        <span class="text-2xl">📢</span>
                                    </div>
                                @elseif($notification->type === 'withdrawal_approved')
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-2xl">💰</span>
                                    </div>
                                @else
                                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                        <span class="text-2xl">🔔</span>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $notification->title }}
                                            @if(!$notification->is_read)
                                                <span class="ml-2 inline-block w-2 h-2 bg-[#F5A623] rounded-full"></span>
                                            @endif
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600">{{ $notification->message }}</p>
                                        <p class="mt-2 text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>

                                    @if(!$notification->is_read)
                                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="ml-4">
                                        @csrf
                                        <button type="submit" class="text-xs text-[#2D7A67] hover:text-[#1A5647] font-semibold">
                                            {{ __('Mark as read') }}
                                        </button>
                                    </form>
                                    @endif
                                </div>

                                @if(isset($notification->data['campaign_slug']))
                                    <a href="{{ url('/campaigns/' . $notification->data['campaign_slug']) }}" class="mt-3 inline-block text-sm text-[#2D7A67] hover:text-[#1A5647] font-semibold">
                                        {{ __('View Campaign') }} →
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-5xl">🔔</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('No notifications yet') }}</h3>
                <p class="text-gray-600">{{ __('You will see your notifications here when you have some.') }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
