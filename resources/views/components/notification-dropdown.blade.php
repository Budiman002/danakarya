<div class="relative" x-data="{ open: false, unreadCount: {{ Auth::user()->notifications()->unread()->count() }} }">
    <button @click="open = !open" class="relative p-2 text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-100 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        @if(Auth::user()->notifications()->unread()->count() > 0)
        <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-bold">
            {{ Auth::user()->notifications()->unread()->count() }}
        </span>
        @endif
    </button>

    <div
        x-show="open"
        @click.away="open = false"
        x-transition
        class="absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-xl z-50 border border-gray-200"
        style="display: none;"
    >
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-900">{{ __('Notifications') }}</h3>
            @if(Auth::user()->notifications()->unread()->count() > 0)
            <form action="{{ route('notifications.read-all') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-xs text-[#2D7A67] hover:text-[#1A5647] font-semibold">
                    {{ __('Mark all as read') }}
                </button>
            </form>
            @endif
        </div>

        <div class="max-h-96 overflow-y-auto">
            @php
                $notifications = Auth::user()->notifications()->recent()->limit(10)->get();
            @endphp

            @if($notifications->count() > 0)
                @foreach($notifications as $notification)
                    <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition {{ $notification->is_read ? 'opacity-60' : '' }}">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                @if($notification->type === 'welcome')
                                    <span class="text-2xl">🎉</span>
                                @elseif($notification->type === 'new_donation')
                                    <span class="text-2xl">💰</span>
                                @elseif($notification->type === 'donation_success')
                                    <span class="text-2xl">✅</span>
                                @elseif($notification->type === 'campaign_approved')
                                    <span class="text-2xl">✅</span>
                                @elseif($notification->type === 'campaign_rejected')
                                    <span class="text-2xl">❌</span>
                                @elseif($notification->type === 'campaign_update')
                                    <span class="text-2xl">📢</span>
                                @elseif($notification->type === 'withdrawal_approved')
                                    <span class="text-2xl">💰</span>
                                @else
                                    <span class="text-2xl">🔔</span>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ $notification->title }}
                                    @if(!$notification->is_read)
                                        <span class="ml-1 inline-block w-2 h-2 bg-[#F5A623] rounded-full"></span>
                                    @endif
                                </p>
                                <p class="mt-1 text-xs text-gray-600 line-clamp-2">{{ $notification->message }}</p>
                                <p class="mt-1 text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>

                                <div class="mt-2 flex gap-2">
                                    @if(isset($notification->data['campaign_slug']))
                                        <a href="{{ url('/campaigns/' . $notification->data['campaign_slug']) }}" class="text-xs text-[#2D7A67] hover:text-[#1A5647] font-semibold">
                                            {{ __('View Campaign') }} →
                                        </a>
                                    @endif

                                    @if(!$notification->is_read)
                                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-xs text-gray-500 hover:text-gray-700">
                                                {{ __('Mark as read') }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="p-8 text-center">
                    <span class="text-4xl">🔔</span>
                    <p class="mt-2 text-sm text-gray-600">{{ __('No notifications yet') }}</p>
                </div>
            @endif
        </div>

        @if($notifications->count() > 0)
        <div class="p-3 border-t border-gray-200 text-center">
            <a href="{{ route('notifications') }}" class="text-sm text-[#2D7A67] hover:text-[#1A5647] font-semibold">
                {{ __('View all notifications') }}
            </a>
        </div>
        @endif
    </div>
</div>
