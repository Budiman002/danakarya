@extends('layouts.profile')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Settings</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Change Password Section -->
    <div class="p-6 border-2 border-gray-200 rounded-xl mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Change Password</h3>
        
        <form method="POST" action="{{ route('password.change') }}">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-900 mb-2">
                    Old Password <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    id="current_password" 
                    name="current_password" 
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-[#7DD3C0] focus:border-transparent @error('current_password') border-red-500 @enderror"
                    required
                >
                @error('current_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-900 mb-2">
                    New Password <span class="text-red-500">*</span>
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
                <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
            </div>

            <!-- Confirm New Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-900 mb-2">
                    Confirm Password <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-[#7DD3C0] focus:border-transparent"
                    required
                >
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="px-6 py-3 bg-[#5AB9A0] hover:bg-[#4A9A88] text-white font-semibold rounded-full transition duration-200"
            >
                Change Password
            </button>
        </form>
    </div>

    <!-- Language Preference Section -->
    <div class="p-6 border-2 border-gray-200 rounded-xl">
        <h3 class="text-lg font-semibold text-gray-900 mb-3">Language Preference</h3>
        <p class="text-sm text-gray-600">Language switcher coming in Checkpoint 21</p>
        <div class="mt-4 flex gap-3">
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium">🇮🇩 Indonesia</button>
            <button class="px-4 py-2 border border-gray-300 text-gray-600 rounded-lg">🇬🇧 English</button>
        </div>
    </div>
</div>
@endsection