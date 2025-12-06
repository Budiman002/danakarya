@extends('layouts.profile')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Notifications</h2>
        <button class="text-sm text-[#5AB9A0] hover:underline font-medium">Mark all as read</button>
    </div>

    <!-- Notifications List -->
    <div class="space-y-4">
        <!-- Today Section -->
        <div>
            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Today</h3>
            
            <!-- Notification Item Placeholder -->
            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"></div>
                <div class="flex-1">
                    <div class="h-4 bg-gray-300 rounded w-3/4 mb-2"></div>
                    <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                </div>
                <span class="text-xs text-gray-400">2h ago</span>
            </div>

            <div class="flex items-start gap-4 p-4 rounded-lg hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"></div>
                <div class="flex-1">
                    <div class="h-4 bg-gray-300 rounded w-2/3 mb-2"></div>
                    <div class="h-3 bg-gray-200 rounded w-1/3"></div>
                </div>
                <span class="text-xs text-gray-400">5h ago</span>
            </div>
        </div>

        <!-- Yesterday Section -->
        <div class="mt-6">
            <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Yesterday</h3>
            
            <div class="flex items-start gap-4 p-4 rounded-lg hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"></div>
                <div class="flex-1">
                    <div class="h-4 bg-gray-300 rounded w-3/4 mb-2"></div>
                    <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                </div>
                <span class="text-xs text-gray-400">1d ago</span>
            </div>

            <div class="flex items-start gap-4 p-4 rounded-lg hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0"></div>
                <div class="flex-1">
                    <div class="h-4 bg-gray-300 rounded w-2/3 mb-2"></div>
                    <div class="h-3 bg-gray-200 rounded w-2/5"></div>
                </div>
                <span class="text-xs text-gray-400">1d ago</span>
            </div>
        </div>

        <!-- Empty State Message -->
        <div class="text-center py-12 mt-8">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Notification System</h3>
            <p class="text-gray-600">Full notification functionality coming soon!</p>
            <p class="text-sm text-gray-500 mt-2">This is a placeholder page for Checkpoint 2</p>
        </div>
    </div>
</div>
@endsection