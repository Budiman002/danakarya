@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-[#2D7A67] to-[#1A5647] text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Text -->
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ __('About DanaKarya') }}</h1>
                <p class="text-xl text-gray-100 leading-relaxed">
                    {{ __('Memberdayakan UMKM Indonesia untuk mewujudkan impian mereka melalui platform crowdfunding yang aman dan terpercaya.') }}
                </p>
            </div>
            
            <!-- Image -->
            <div class="relative">
                <img src="{{ asset('images/AuthBackground.png') }}" alt="About DanaKarya" class="rounded-2xl shadow-2xl">
            </div>
        </div>
    </div>
</section>

<!-- Mission Statement -->
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ __('Our Mission') }}</h2>
        </div>

        <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
            <p>
                {{ __('DanaKarya adalah platform crowdfunding yang didedikasikan untuk membantu Usaha Mikro, Kecil, dan Menengah (UMKM) Indonesia berkembang dan mewujudkan impian mereka. Kami percaya bahwa setiap bisnis kecil memiliki potensi besar untuk membawa perubahan positif bagi masyarakat dan ekonomi Indonesia.') }}
            </p>

            <p>
                {{ __('Melalui platform kami, para pemilik UMKM dapat mengajukan campaign untuk mendapatkan pendanaan dari komunitas backers yang peduli. Dengan transparansi penuh dan sistem yang aman, kami memastikan setiap dana yang terkumpul digunakan sesuai tujuan dan memberikan dampak nyata bagi perkembangan bisnis UMKM.') }}
            </p>
        </div>
    </div>
</section>

<!-- Statistics -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('Our Impact') }}</h2>
            <p class="text-lg text-gray-600">{{ __('Bersama-sama kita telah membuat perbedaan') }}</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-[#2D7A67] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <p class="text-4xl font-bold text-gray-900 mb-2">{{ $totalCampaigns ?? 0 }}+</p>
                <p class="text-gray-600">{{ __('Campaigns Launched') }}</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-[#2D7A67] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-4xl font-bold text-gray-900 mb-2">{{ $fundedCampaigns ?? 0 }}+</p>
                <p class="text-gray-600">{{ __('Successfully Funded') }}</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-[#2D7A67] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <p class="text-4xl font-bold text-gray-900 mb-2">{{ $totalBackers ?? 0 }}+</p>
                <p class="text-gray-600">{{ __('Happy Backers') }}</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-[#2D7A67] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-4xl font-bold text-gray-900 mb-2">Rp {{ number_format(($totalRaised ?? 0) / 1000000, 0) }}M+</p>
                <p class="text-gray-600">{{ __('Total Funds Raised') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Why DanaKarya -->
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('Why Choose DanaKarya?') }}</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                {{ __('Platform terpercaya dengan sistem yang transparan dan aman untuk mendukung pertumbuhan UMKM Indonesia') }}
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-[#F5A623] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('Aman & Terpercaya') }}</h3>
                <p class="text-gray-600">
                    {{ __('Sistem keamanan berlapis dan proses verifikasi ketat untuk melindungi dana Anda') }}
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-[#F5A623] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('Transparan') }}</h3>
                <p class="text-gray-600">
                    {{ __('Tracking progress campaign secara real-time dan laporan penggunaan dana yang jelas') }}
                </p>
            </div>
            
            <!-- Feature 3 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-[#F5A623] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('Komunitas Solid') }}</h3>
                <p class="text-gray-600">
                    {{ __('Bergabung dengan ribuan backers yang peduli terhadap perkembangan UMKM Indonesia') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-[#2D7A67] to-[#1A5647] text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">{{ __('Siap Mewujudkan Impian Anda?') }}</h2>
        <p class="text-xl text-gray-100 mb-8">
            {{ __('Bergabunglah dengan DanaKarya dan mulai perjalanan menuju kesuksesan bisnis Anda') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @guest
                <a href="{{ route('register') }}" class="px-8 py-4 bg-[#F5A623] hover:bg-[#E09612] text-white font-semibold rounded-lg transition shadow-lg">
                    {{ __('Start Your Campaign') }}
                </a>
            @else
                <a href="{{ route('campaigns.index') }}" class="px-8 py-4 bg-[#F5A623] hover:bg-[#E09612] text-white font-semibold rounded-lg transition shadow-lg">
                    {{ __('Browse Campaigns') }}
                </a>
            @endguest
            <a href="/contact" class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-semibold rounded-lg transition border-2 border-white/30">
                {{ __('Contact Us') }}
            </a>
        </div>
    </div>
</section>
@endsection