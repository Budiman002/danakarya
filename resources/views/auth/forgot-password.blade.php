@extends('layouts.auth')

@section('content')
<div class="bg-[#7DD3C0] rounded-3xl p-8 shadow-lg">
    <h2 class="text-2xl font-bold text-gray-900 mb-2 text-center">Forgot Password</h2>
    <p class="text-center text-gray-700 mb-6 text-sm">Enter your email to reset password</p>

    <!-- Success Message -->
    @if(session('status'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email -->
        <div class="mb-6">
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

        <!-- Submit Button -->
        <button 
            type="submit" 
            class="w-full bg-[#5AB9A0] hover:bg-[#4A9A88] text-white font-semibold py-3 rounded-full transition duration-200"
        >
            Send Reset Link
        </button>

        <!-- Back to Login -->
        <p class="text-center text-sm text-gray-700 mt-4">
            <a href="{{ route('login') }}" class="text-[#2D7A67] hover:underline font-semibold">← Back to Sign In</a>
        </p>
    </form>
</div>
@endsection