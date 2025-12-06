@extends('layouts.public')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-[#2D7A67] to-[#1A5647] text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Browse Campaigns</h1>
        <p class="text-lg text-gray-100">Dukung UMKM Indonesia untuk mewujudkan impian mereka</p>
    </div>
</section>

<!-- Filters & Campaigns -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <aside class="lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                    <!-- Search -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-900 mb-3">Search</h3>
                        <form method="GET" action="{{ route('campaigns.index') }}">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                            @endif
                            
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="search" 
                                    value="{{ request('search') }}"
                                    placeholder="Search campaigns..."
                                    class="w-full px-4 py-2 pr-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent"
                                >
                                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#2D7A67]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Sort -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-900 mb-3">Sort By</h3>
                        <form method="GET" action="{{ route('campaigns.index') }}" id="sortForm">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            
                            <select 
                                name="sort" 
                                onchange="document.getElementById('sortForm').submit()"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent"
                            >
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                                <option value="ending" {{ request('sort') == 'ending' ? 'selected' : '' }}>Ending Soon</option>
                            </select>
                        </form>
                    </div>

                    <!-- Categories Filter -->
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-3">Categories</h3>
                        <div class="space-y-2">
                            <a href="{{ route('campaigns.index', array_merge(request()->except('category'), request()->only(['search', 'sort']))) }}" 
                               class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ !request('category') ? 'bg-[#2D7A67] text-white hover:bg-[#1A5647]' : 'text-gray-700' }}">
                                <span>All Categories</span>
                                <span class="text-sm {{ !request('category') ? 'text-white' : 'text-gray-500' }}">{{ $campaigns->total() }}</span>
                            </a>
    
                            @foreach($categories as $category)
                                <a href="{{ route('campaigns.index', array_merge(['category' => $category->slug], request()->only(['search', 'sort']))) }}" 
                                   class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ request('category') == $category->slug ? 'bg-[#2D7A67] text-white hover:bg-[#1A5647]' : 'text-gray-700' }}">
                                    <span class="flex items-center gap-2">
                                        <span>{{ $category->icon }}</span>
                                        <span>{{ $category->name }}</span>
                                    </span>
                                    <span class="text-sm {{ request('category') == $category->slug ? 'text-white' : 'text-gray-500' }}">{{ $category->campaigns_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @if(request('category') || request('search') || request('sort'))
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('campaigns.index') }}" class="block w-full px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-center font-semibold rounded-lg transition">
                                Clear All Filters
                            </a>
                        </div>
                    @endif
                </div>
            </aside>

            <!-- Campaign Grid -->
            <main class="flex-1">
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">
                        Showing <span class="font-semibold">{{ $campaigns->firstItem() ?? 0 }}-{{ $campaigns->lastItem() ?? 0 }}</span> 
                        of <span class="font-semibold">{{ $campaigns->total() }}</span> campaigns
                    </p>
                </div>

                @if($campaigns->count() > 0)
                    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                        @foreach($campaigns as $campaign)
                            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition group">
                                <div class="relative h-48 bg-gray-200 overflow-hidden">
                                    @if($campaign->image)
                                        <img src="{{ asset($campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-[#2D7A67] to-[#7DD3C0] flex items-center justify-center">
                                            <span class="text-white text-4xl font-bold">{{ substr($campaign->title, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div class="absolute top-3 right-3">
                                        <span class="px-3 py-1 bg-[#F5A623] text-white text-xs font-semibold rounded-full">
                                            {{ $campaign->category->name }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-[#2D7A67] transition">
                                        {{ $campaign->title }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ Str::limit($campaign->description, 100) }}
                                    </p>
                                    
                                    @php
                                        $percentage = $campaign->target_amount > 0 
                                            ? min(($campaign->current_amount / $campaign->target_amount) * 100, 100) 
                                            : 0;
                                    @endphp
                                    <div class="mb-4">
                                        <div class="flex justify-between text-sm mb-2">
                                            <span class="font-semibold text-[#2D7A67]">{{ number_format($percentage, 0) }}%</span>
                                            <span class="text-gray-600">{{ \Carbon\Carbon::parse($campaign->deadline)->diffForHumans() }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-[#2D7A67] h-2 rounded-full transition-all" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center mb-4">
                                        <div>
                                            <p class="text-lg font-bold text-gray-900">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
                                            <p class="text-xs text-gray-600">of Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-bold text-gray-900">{{ $campaign->donations_count }}</p>
                                            <p class="text-xs text-gray-600">Backers</p>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('campaigns.show', $campaign->slug) }}" class="block w-full px-4 py-3 bg-[#F5A623] hover:bg-[#E09612] text-white text-center font-semibold rounded-lg transition">
                                        View Campaign
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $campaigns->links() }}
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                        <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No campaigns found</h3>
                        <p class="text-gray-600 mb-6">Try adjusting your search or filters to find what you're looking for.</p>
                        <a href="{{ route('campaigns.index') }}" class="inline-block px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition">
                            Clear Filters
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>
</section>
@endsection