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

                <!-- Recent Backers -->
                @if($campaign->donations->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Recent Backers ({{ $campaign->donations->count() }})</h2>
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
                </div>
                @endif
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
                    <a href="#" class="block w-full px-6 py-4 bg-[#F5A623] hover:bg-[#E09612] text-white text-center font-bold rounded-lg transition mb-4">
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