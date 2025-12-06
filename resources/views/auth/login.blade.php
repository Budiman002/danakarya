@extends('layouts.auth')

@section('content')
<div class="bg-[#7DD3C0] rounded-3xl p-8 shadow-lg">
    <h2 class="text-2xl font-bold text-gray-900 mb-2 text-center">Welcome Back!</h2>
    <p class="text-center text-gray-700 mb-6 text-sm">Sign in to continue</p>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">
                Email
            </label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-[#7DD3C0] focus:border-transparent @error('email') border-red-500 @enderror"
                required
                autofocus
            >
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-900 mb-2">
                Password
            </label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-[#7DD3C0] focus:border-transparent @error('password') border-red-500 @enderror"
                required
            >
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-6 flex items-center justify-between">
            <label class="flex items-center">
                <input 
                    type="checkbox" 
                    name="remember" 
                    class="w-4 h-4 text-[#7DD3C0] focus:ring-[#7DD3C0] border-gray-300 rounded"
                >
                <span class="ml-2 text-sm text-gray-900">Remember Me</span>
            </label>

            <a href="{{ route('password.request') }}" class="text-sm text-[#2D7A67] hover:underline font-medium">
                Forgot Password?
            </a>
        </div>

        <!-- Submit Button -->
        <button 
            type="submit" 
            class="w-full bg-[#5AB9A0] hover:bg-[#4A9A88] text-white font-semibold py-3 rounded-full transition duration-200"
        >
            Sign In
        </button>

        <!-- Register Link -->
        <p class="text-center text-sm text-gray-700 mt-4">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-[#2D7A67] hover:underline font-semibold">Sign Up</a>
        </p>
    </form>
</div>
@endsection