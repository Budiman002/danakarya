@extends('layouts.profile')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Donation History</h2>
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-600">Filter By:</span>
            <button class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Donation Cards List -->
    <div class="space-y-4">
        <!-- Donation Card Placeholder 1 -->
        <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-[#7DD3C0] transition">
            <div class="flex gap-4">
                <!-- Campaign Image Placeholder -->
                <div class="w-24 h-24 bg-gray-300 rounded-lg flex-shrink-0"></div>
                
                <!-- Content -->
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <div class="h-5 bg-gray-300 rounded w-64 mb-2"></div>
                            <div class="h-3 bg-gray-200 rounded w-48"></div>
                        </div>
                        <span class="text-xs text-gray-500">date</span>
                    </div>
                    
                    <!-- Amount and Status -->
                    <div class="flex items-center justify-between mt-4">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">999999 BTC</p>
                            <div class="flex gap-2 mt-2">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full">Health</span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Food</span>
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs rounded-full">Sports</span>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="w-48">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-600">Fund Raised</span>
                                <span class="text-gray-900 font-semibold">95%</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-[#7DD3C0]" style="width: 95%"></div>
                            </div>
                        </div>
                        
                        <button class="px-6 py-2 bg-[#7DD3C0] text-white rounded-full hover:bg-[#5AB9A0] transition font-medium">
                            See Campaign Page
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donation Card Placeholder 2 -->
        <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-[#7DD3C0] transition">
            <div class="flex gap-4">
                <div class="w-24 h-24 bg-gray-300 rounded-lg flex-shrink-0"></div>
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <div class="h-5 bg-gray-300 rounded w-56 mb-2"></div>
                            <div class="h-3 bg-gray-200 rounded w-40"></div>
                        </div>
                        <span class="text-xs text-gray-500">date</span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">999999 BTC</p>
                            <div class="flex gap-2 mt-2">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full">Health</span>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Food</span>
                            </div>
                        </div>
                        <div class="w-48">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-600">Fund Raised</span>
                                <span class="text-gray-900 font-semibold">60%</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-[#7DD3C0]" style="width: 60%"></div>
                            </div>
                        </div>
                        <button class="px-6 py-2 bg-[#7DD3C0] text-white rounded-full hover:bg-[#5AB9A0] transition font-medium">
                            See Campaign Page
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donation Card Placeholder 3 -->
        <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-[#7DD3C0] transition">
            <div class="flex gap-4">
                <div class="w-24 h-24 bg-gray-300 rounded-lg flex-shrink-0"></div>
                <div class="flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <div class="h-5 bg-gray-300 rounded w-60 mb-2"></div>
                            <div class="h-3 bg-gray-200 rounded w-44"></div>
                        </div>
                        <span class="text-xs text-gray-500">date</span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">999999 BTC</p>
                            <div class="flex gap-2 mt-2">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Food</span>
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs rounded-full">Sports</span>
                            </div>
                        </div>
                        <div class="w-48">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-600">Fund Raised</span>
                                <span class="text-gray-900 font-semibold">80%</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-[#7DD3C0]" style="width: 80%"></div>
                            </div>
                        </div>
                        <button class="px-6 py-2 bg-[#7DD3C0] text-white rounded-full hover:bg-[#5AB9A0] transition font-medium">
                            See Campaign Page
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State Message -->
        <div class="text-center py-12 mt-8">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Donation History System</h3>
            <p class="text-gray-600">Full donation tracking coming soon!</p>
            <p class="text-sm text-gray-500 mt-2">This is a placeholder page for Checkpoint 2</p>
        </div>
    </div>
</div>
@endsection