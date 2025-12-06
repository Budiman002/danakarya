@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-[#2D7A67] to-[#1A5647] text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Get in Touch</h1>
        <p class="text-xl text-gray-100">
            Punya pertanyaan? Tim DanaKarya siap membantu Anda!
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Contact Information</h2>
                <p class="text-gray-600 mb-8">
                    Hubungi kami melalui channel di bawah ini atau isi form, dan kami akan merespons secepat mungkin.
                </p>
                
                <!-- Contact Cards -->
                <div class="space-y-6">
                    <!-- Email -->
                    <div class="flex items-start gap-4 p-6 bg-white rounded-xl shadow-md">
                        <div class="w-12 h-12 bg-[#2D7A67] rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                            <a href="mailto:gmail@BUDI.com" class="text-[#2D7A67] hover:underline">gmail@BUDI.com</a>
                        </div>
                    </div>
                    
                    <!-- Phone -->
                    <div class="flex items-start gap-4 p-6 bg-white rounded-xl shadow-md">
                        <div class="w-12 h-12 bg-[#2D7A67] rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Phone</h3>
                            <a href="tel:+6285381008349" class="text-[#2D7A67] hover:underline">+62 853-8100-8349</a>
                        </div>
                    </div>
                    
            <!-- Address -->
<div class="flex items-start gap-4 p-6 bg-white rounded-xl shadow-md">
    <div class="w-12 h-12 bg-[#2D7A67] rounded-full flex items-center justify-center flex-shrink-0">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
    </div>
    <div>
        <h3 class="font-semibold text-gray-900 mb-1">Address</h3>
        <p class="text-gray-600">
            Jl. Kebon Jeruk Raya No. 27<br>
            Jakarta Barat, DKI Jakarta 11530<br>
            Indonesia
        </p>
    </div>
</div>
                
            <!-- Social Media -->
        <div class="mt-8">
            <h3 class="font-semibold text-gray-900 mb-4">Follow Us</h3>
        <div class="flex gap-3">
        <!-- Facebook -->
        <a href="#" class="w-10 h-10 bg-[#2D7A67] hover:bg-[#1A5647] rounded-full flex items-center justify-center transition group">
            <span class="text-white font-bold text-lg">f</span>
        </a>
        <!-- Twitter -->
        <a href="#" class="w-10 h-10 bg-[#2D7A67] hover:bg-[#1A5647] rounded-full flex items-center justify-center transition group">
            <span class="text-white font-bold text-lg">𝕏</span>
        </a>
        <!-- Instagram -->
        <a href="#" class="w-10 h-10 bg-[#2D7A67] hover:bg-[#1A5647] rounded-full flex items-center justify-center transition group">
            <span class="text-white font-bold text-lg">📷</span>
        </a>
        <!-- LinkedIn -->
        <a href="#" class="w-10 h-10 bg-[#2D7A67] hover:bg-[#1A5647] rounded-full flex items-center justify-center transition group">
            <span class="text-white font-bold text-lg">in</span>
        </a>
    </div>
</div>
            
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Send Us a Message</h2>
                
                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-900 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('name') border-red-500 @enderror"
                            required
                        >
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-900 mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('email') border-red-500 @enderror"
                            required
                        >
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-900 mb-2">
                            Subject <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="subject" 
                            name="subject" 
                            value="{{ old('subject') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('subject') border-red-500 @enderror"
                            required
                        >
                        @error('subject')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-900 mb-2">
                            Message <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="message" 
                            name="message" 
                            rows="6"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('message') border-red-500 @enderror"
                            required
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full px-8 py-4 bg-[#F5A623] hover:bg-[#E09612] text-white font-semibold rounded-lg transition shadow-lg"
                    >
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-[#2D7A67] to-[#1A5647] text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Can't Find Your Answer?</h2>
        <p class="text-xl text-gray-100 mb-8">
            Tenang, tim DanaKarya siap membantu kamu! Hubungi kami langsung jika kamu tidak menemukan jawaban yang kamu cari.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="mailto:gmail@BUDI.com" class="px-8 py-4 bg-[#F5A623] hover:bg-[#E09612] text-white font-semibold rounded-lg transition shadow-lg">
                Email Us
            </a>
            <a href="tel:+6285381008349" class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-semibold rounded-lg transition border-2 border-white/30">
                Call Us
            </a>
        </div>
    </div>
</section>
@endsection