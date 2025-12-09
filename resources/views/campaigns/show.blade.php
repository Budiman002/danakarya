@extends('layouts.public')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="flex-1">
                <!-- Campaign Image -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    @if($campaign->image)
                        <img src="{{ asset($campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-[#2D7A67] to-[#7DD3C0] flex items-center justify-center">
                            <span class="text-white text-6xl font-bold">{{ substr($campaign->title, 0, 1) }}</span>
                        </div>
                    @endif
                </div>

                <!-- Campaign Info -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-[#F5A623] text-white text-sm font-semibold rounded-full">
                            {{ $campaign->category->icon }} {{ $campaign->category->name }}
                        </span>
                        @if($campaign->status === 'active')
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                                Active
                            </span>
                        @elseif($campaign->status === 'funded')
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">
                                Funded
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $campaign->title }}</h1>

                    <div class="flex items-center gap-4 text-gray-600 mb-6">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 bg-[#7DD3C0] rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">{{ substr($campaign->user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="text-sm">Created by</p>
                                <p class="font-semibold text-gray-900">{{ $campaign->user->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <h2 class="text-xl font-bold text-gray-900 mb-3">About This Campaign</h2>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $campaign->description }}</p>
                    </div>
                </div>

                <!-- FAQ Section -->
                @if($campaign->faq_goal || $campaign->faq_fund_usage || $campaign->faq_timeline || $campaign->faq_custom_1_question || $campaign->faq_custom_2_question)
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Frequently Asked Questions</h2>
                    
                    <div class="space-y-4">
                        @if($campaign->faq_goal)
                        <details class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <summary class="font-semibold text-gray-900 cursor-pointer flex items-center gap-2">
                                <span>📌</span>
                                <span>Apa tujuan utama campaign ini?</span>
                            </summary>
                            <p class="mt-3 text-gray-700 leading-relaxed pl-6">{{ $campaign->faq_goal }}</p>
                        </details>
                        @endif
                        
                        @if($campaign->faq_fund_usage)
                        <details class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <summary class="font-semibold text-gray-900 cursor-pointer flex items-center gap-2">
                                <span>💰</span>
                                <span>Bagaimana dana yang terkumpul akan digunakan?</span>
                            </summary>
                            <p class="mt-3 text-gray-700 leading-relaxed pl-6">{{ $campaign->faq_fund_usage }}</p>
                        </details>
                        @endif
                        
                        @if($campaign->faq_timeline)
                        <details class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <summary class="font-semibold text-gray-900 cursor-pointer flex items-center gap-2">
                                <span>⏰</span>
                                <span>Kapan campaign ini akan terealisasi?</span>
                            </summary>
                            <p class="mt-3 text-gray-700 leading-relaxed pl-6">{{ $campaign->faq_timeline }}</p>
                        </details>
                        @endif
                        
                        @if($campaign->faq_custom_1_question)
                        <details class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <summary class="font-semibold text-gray-900 cursor-pointer flex items-center gap-2">
                                <span>❓</span>
                                <span>{{ $campaign->faq_custom_1_question }}</span>
                            </summary>
                            <p class="mt-3 text-gray-700 leading-relaxed pl-6">{{ $campaign->faq_custom_1_answer }}</p>
                        </details>
                        @endif
                        
                        @if($campaign->faq_custom_2_question)
                        <details class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <summary class="font-semibold text-gray-900 cursor-pointer flex items-center gap-2">
                                <span>❓</span>
                                <span>{{ $campaign->faq_custom_2_question }}</span>
                            </summary>
                            <p class="mt-3 text-gray-700 leading-relaxed pl-6">{{ $campaign->faq_custom_2_answer }}</p>
                        </details>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Campaign Updates -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6" x-data="{ lightboxImage: null }">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-900">{{ __('Campaign Updates') }} ({{ $campaign->updates_count }})</h2>
                    </div>

                    @if($campaign->updates->count() > 0)
                        <div class="space-y-6">
                            @foreach($campaign->updates as $update)
                                <div class="border-b border-gray-200 last:border-0 pb-6 last:pb-0">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $update->title }}</h3>
                                        <span class="text-sm text-gray-500">{{ $update->created_at->diffForHumans() }}</span>
                                    </div>

                                    @if($update->image)
                                        <img
                                            src="{{ asset('storage/' . $update->image) }}"
                                            alt="{{ $update->title }}"
                                            class="w-full h-64 object-cover rounded-lg mb-3 cursor-pointer hover:opacity-90 transition"
                                            @click="lightboxImage = '{{ asset('storage/' . $update->image) }}'"
                                        >
                                    @endif

                                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $update->content }}</p>
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
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">{{ __('No updates yet') }}</h3>
                            <p class="text-gray-500">{{ __('The creator hasn\'t posted any updates for this campaign.') }}</p>
                        </div>
                    @endif
                </div>

                <!-- Recent Backers -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">{{ __('Recent Backers') }} ({{ $campaign->donations_count }})</h2>

                    @if($campaign->donations->count() > 0)
                        <div class="space-y-3">
                            @foreach($campaign->donations->take(10) as $donation)
                                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-[#7DD3C0] rounded-full flex items-center justify-center">
                                            <span class="text-white font-bold">{{ substr($donation->user->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $donation->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $donation->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-[#2D7A67]">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">{{ __('No backers yet') }}</h3>
                            <p class="text-gray-500 mb-4">{{ __('Be the first to support this campaign!') }}</p>
                            <a href="{{ route('donations.create', $campaign->slug) }}" class="inline-flex items-center px-6 py-3 bg-[#F5A623] hover:bg-[#E09612] text-white font-semibold rounded-lg transition">
                                {{ __('Back This Project') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:w-96">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <!-- Progress -->
                    @php
                        $percentage = $campaign->target_amount > 0 
                            ? min(($campaign->current_amount / $campaign->target_amount) * 100, 100) 
                            : 0;
                    @endphp

                    <div class="mb-6">
                        <div class="flex justify-between items-baseline mb-2">
                            <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
                        </div>
                        <p class="text-gray-600 mb-4">raised of Rp {{ number_format($campaign->target_amount, 0, ',', '.') }} goal</p>
                        
                        <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                            <div class="bg-[#2D7A67] h-3 rounded-full transition-all" style="width: {{ $percentage }}%"></div>
                        </div>
                        <p class="text-sm text-gray-600">{{ number_format($percentage, 1) }}% funded</p>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b">
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $campaign->donations_count }}</p>
                            <p class="text-sm text-gray-600">Backers</p>
                        </div>
                        <div>
                            @php
                                $deadline = \Carbon\Carbon::parse($campaign->deadline);
                                $now = \Carbon\Carbon::now();
                                $daysRemaining = (int) $now->diffInDays($deadline, false);
                            @endphp

                            @if($daysRemaining < 0)
                                <p class="text-2xl font-bold text-red-600">Ended</p>
                                <p class="text-sm text-gray-600">{{ abs($daysRemaining) }} {{ abs($daysRemaining) === 1 ? 'day' : 'days' }} ago</p>
                            @elseif($daysRemaining === 0)
                                <p class="text-2xl font-bold text-orange-600">Last day!</p>
                                <p class="text-sm text-gray-600">Ends today</p>
                            @else
                                <p class="text-2xl font-bold text-gray-900">{{ $daysRemaining }}</p>
                                <p class="text-sm text-gray-600">Days to go</p>
                            @endif
                        </div>
                    </div>

                    <!-- Donate Button -->
                    <a href="{{ route('donations.create', $campaign->slug) }}" class="block w-full px-6 py-4 bg-[#F5A623] hover:bg-[#E09612] text-white text-center font-bold rounded-lg transition mb-4">
                        Back This Project
                    </a>

                    <!-- Campaign Details -->
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Creator</span>
                            <span class="font-semibold text-gray-900">{{ $campaign->user->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Category</span>
                            <span class="font-semibold text-gray-900">{{ $campaign->category->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Deadline</span>
                            <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($campaign->deadline)->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Created</span>
                            <span class="font-semibold text-gray-900">{{ $campaign->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection