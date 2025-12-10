<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Profile' }} - DanaKarya</title>
    <!-- Tailwind CSS & Alpine.js via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-[#B8E6D5]">
    <!-- Navbar -->
    <nav class="bg-[#7DD3C0] shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/LogoDanaKarya.png') }}" alt="DanaKarya" class="h-14">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-white hover:text-gray-100 transition">Home</a>
                    <a href="/about" class="text-white hover:text-gray-100 transition">About</a>
                    <a href="/campaigns" class="text-white hover:text-gray-100 transition">Donation List</a>
                    <a href="/contact" class="text-white hover:text-gray-100 transition">Contact Us</a>
                </div>

                <!-- User Dropdown -->
                <div class="hidden md:flex items-center gap-4">
                    @include('components.language-switcher')

                    @auth
                    @include('components.notification-dropdown')
                    @endauth

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white/20 transition">
                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                                <span class="text-[#7DD3C0] font-bold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span class="text-white font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                            <a href="{{ route('profile') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('profile') ? 'bg-gray-50' : '' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                My Profile
                            </a>
                            <a href="{{ route('settings') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('settings') ? 'bg-gray-50' : '' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Settings
                            </a>
                            <hr class="my-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 w-full text-left">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-6">
                <!-- Sidebar -->
                <aside class="w-64 bg-white rounded-2xl shadow-lg p-6 h-fit">
                    <!-- User Info -->
                    <div class="flex flex-col items-center mb-6 pb-6 border-b border-gray-200">
                        <div class="w-20 h-20 bg-[#7DD3C0] rounded-full flex items-center justify-center mb-3">
                            <span class="text-white text-2xl font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 text-center">{{ Auth::user()->name }}</h3>
                        <p class="text-sm text-gray-600 text-center">{{ Auth::user()->email }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ Auth::user()->address ?? 'No address set' }}</p>
                    </div>

                    <!-- Menu -->
                    <nav class="space-y-2">
                        <h4 class="text-xs font-semibold text-gray-500 uppercase mb-3">Menu</h4>
                        
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span class="text-gray-700">Home</span>
                        </a>

                        <a href="{{ route('settings') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('settings') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <span class="text-gray-700">Change Password</span>
                        </a>

                        <a href="{{ route('notifications') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('notifications') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="text-gray-700">Notification</span>
                        </a>

                        @if(Auth::user()->isCreator())
                            <a href="{{ route('creator.campaigns.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition {{ request()->routeIs('creator.campaigns.*') ? 'bg-gray-100 font-semibold' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                               Manage Campaigns
                            </a>
                        @else
                            <a href="{{ route('campaigns.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <span class="text-gray-700">Browse Campaigns</span>
                            </a>
                        @endif

                        <a href="{{ route('donation.history') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('donation.history') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-gray-700">Donation history</span>
                        </a>

                        <a href="{{ route('profile') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('profile') ? 'bg-gray-100' : '' }}">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-gray-700">Setting</span>
                        </a>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="mt-4 pt-4 border-t border-gray-200">
                            @csrf
                            <button type="submit" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-red-50 transition w-full text-left">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span class="text-red-600 font-medium">Logout</span>
                            </button>
                        </form>
                    </nav>
                </aside>

                <!-- Main Content -->
                <main class="flex-1">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>