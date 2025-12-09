@extends('layouts.creator')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">{{ __('Edit Update') }}</h1>
            <p class="text-gray-600 mt-2">{{ $campaign->title }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('creator.campaigns.updates.update', [$campaign, $update]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-900 mb-2">
                        {{ __('Update Title') }} <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $update->title) }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('title') border-red-500 @enderror"
                        placeholder="{{ __('Enter update title') }}"
                        required
                    >
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-900 mb-2">
                        {{ __('Update Content') }} <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="content"
                        name="content"
                        rows="10"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('content') border-red-500 @enderror"
                        placeholder="{{ __('Write your update content here...') }}"
                        required
                    >{{ old('content', $update->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if($update->image)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-900 mb-2">
                            {{ __('Current Image') }}
                        </label>
                        <img src="{{ asset('storage/' . $update->image) }}" alt="{{ $update->title }}" class="w-48 h-auto rounded-lg">
                    </div>
                @endif

                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-900 mb-2">
                        {{ $update->image ? __('Change Image') : __('Image') }} ({{ __('Optional') }})
                    </label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('image') border-red-500 @enderror"
                    >
                    <p class="text-gray-500 text-sm mt-1">{{ __('Max file size: 2MB') }}</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        class="px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition"
                    >
                        {{ __('Update') }}
                    </button>
                    <a
                        href="{{ route('creator.campaigns.updates.index', $campaign) }}"
                        class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition"
                    >
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
