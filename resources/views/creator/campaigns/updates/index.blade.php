@extends('layouts.creator')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ __('Campaign Updates') }}</h1>
                <p class="text-gray-600 mt-2">{{ $campaign->title }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('creator.campaigns.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
                    {{ __('Back to Campaigns') }}
                </a>
                <a href="{{ route('creator.campaigns.updates.create', $campaign) }}" class="px-4 py-2 bg-[#2D7A67] hover:bg-[#1A5647] text-white rounded-lg transition">
                    {{ __('Post Update') }}
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md" x-data="{ lightboxImage: null }">
            @if($updates->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($updates as $update)
                        <div class="p-6 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $update->title }}</h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ $update->created_at->diffForHumans() }}</p>

                                    @if($update->image)
                                        <img
                                            src="{{ asset('storage/' . $update->image) }}"
                                            alt="{{ $update->title }}"
                                            class="w-48 h-32 object-cover rounded-lg mb-3 cursor-pointer hover:opacity-90 transition"
                                            @click="lightboxImage = '{{ asset('storage/' . $update->image) }}'"
                                        >
                                    @endif

                                    <p class="text-gray-700 line-clamp-2">{{ Str::limit($update->content, 200) }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('creator.campaigns.updates.edit', [$campaign, $update]) }}" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded transition">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('creator.campaigns.updates.destroy', [$campaign, $update]) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded transition">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Lightbox Modal -->
                <div
                    x-show="lightboxImage"
                    x-transition
                    @click="lightboxImage = null"
                    class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4"
                    style="display: none;"
                >
                    <div class="relative max-w-7xl max-h-full">
                        <button
                            @click.stop="lightboxImage = null"
                            class="absolute -top-12 right-0 text-white hover:text-gray-300 text-4xl font-bold"
                        >
                            &times;
                        </button>
                        <img
                            :src="lightboxImage"
                            class="max-w-full max-h-[90vh] object-contain rounded-lg"
                            @click.stop
                        >
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200">
                    {{ $updates->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">{{ __('No updates yet') }}</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ __('Start by posting your first update') }}</p>
                    <div class="mt-6">
                        <a href="{{ route('creator.campaigns.updates.create', $campaign) }}" class="inline-flex items-center px-4 py-2 bg-[#2D7A67] hover:bg-[#1A5647] text-white rounded-lg transition">
                            {{ __('Post Update') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
