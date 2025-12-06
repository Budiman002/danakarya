@extends('layouts.profile')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Account Setting</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- My Profile Section -->
    <div class="mb-8 p-6 border-2 border-gray-200 rounded-xl">
        <div class="flex justify-between items-start mb-4">
            <h3 class="text-lg font-semibold text-gray-900">My Profile</h3>
            <button onclick="document.getElementById('editProfileForm').classList.toggle('hidden')" class="px-4 py-2 border-2 border-gray-300 rounded-full text-gray-700 hover:bg-gray-50 transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                Edit
            </button>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-[#7DD3C0] rounded-full flex items-center justify-center">
                <span class="text-white text-2xl font-bold">{{ substr($user->name, 0, 1) }}</span>
            </div>
            <div>
                <h4 class="font-semibold text-gray-900">{{ $user->name }}</h4>
                <p class="text-sm text-gray-600">{{ $user->email }}</p>
                <p class="text-xs text-gray-500">{{ $user->address ?? 'No address set' }}</p>
            </div>
        </div>
    </div>

    <!-- Personal Information Section -->
    <div class="p-6 border-2 border-gray-200 rounded-xl">
        <div class="flex justify-between items-start mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Personal Information</h3>
        </div>

        <!-- Edit Form (Hidden by default) -->
        <form id="editProfileForm" method="POST" action="{{ route('profile.update') }}" class="hidden space-y-4 mb-6 pb-6 border-b border-gray-200">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-900 mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#7DD3C0] @error('name') border-red-500 @enderror"
                        required
                    >
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#7DD3C0] @error('email') border-red-500 @enderror"
                        required
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-900 mb-2">
                        Phone
                    </label>
                    <input 
                        type="text" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone', $user->phone) }}"
                        placeholder="+62"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#7DD3C0] @error('phone') border-red-500 @enderror"
                    >
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-900 mb-2">
                        Address
                    </label>
                    <input 
                        type="text" 
                        id="address" 
                        name="address" 
                        value="{{ old('address', $user->address) }}"
                        placeholder="Your address"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#7DD3C0] @error('address') border-red-500 @enderror"
                    >
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-gray-900 mb-2">
                    Bio
                </label>
                <textarea 
                    id="bio" 
                    name="bio" 
                    rows="3"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#7DD3C0] @error('bio') border-red-500 @enderror"
                    placeholder="Tell us about yourself..."
                >{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-[#5AB9A0] hover:bg-[#4A9A88] text-white font-semibold rounded-full transition"
                >
                    Save Changes
                </button>
                <button 
                    type="button"
                    onclick="document.getElementById('editProfileForm').classList.add('hidden')"
                    class="px-6 py-2 border-2 border-gray-300 text-gray-700 font-semibold rounded-full hover:bg-gray-50 transition"
                >
                    Cancel
                </button>
            </div>
        </form>

        <!-- Display Info -->
        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-600 mb-1">Full Name</p>
                <p class="font-medium text-gray-900">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Email Address</p>
                <p class="font-medium text-gray-900">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Phone</p>
                <p class="font-medium text-gray-900">{{ $user->phone ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Address</p>
                <p class="font-medium text-gray-900">{{ $user->address ?? '-' }}</p>
            </div>
            <div class="col-span-2">
                <p class="text-sm text-gray-600 mb-1">Bio</p>
                <p class="font-medium text-gray-900">{{ $user->bio ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Role</p>
                <p class="font-medium text-gray-900">{{ ucfirst($user->role) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection