@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Categories Management</h2>
            <p class="text-sm text-gray-600 mt-1">Manage platform categories for campaigns</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create New Category
        </a>
    </div>

    <!-- Best Practices Info -->
    <div class="px-6 py-4 bg-blue-50 border-b border-blue-100">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-blue-900">Best Practices:</p>
                <ul class="text-sm text-blue-800 mt-1 space-y-1">
                    <li>• Keep categories broad (e.g., "Teknologi" not "AI Blockchain IoT")</li>
                    <li>• Use 10-15 active categories maximum for best UX</li>
                    <li>• Deactivate unused categories instead of deleting</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Campaigns</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-50 {{ $category->campaigns_count == 0 && $category->status == 'active' ? 'bg-yellow-50' : '' }}">
                        <!-- Icon -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-3xl">{{ $category->icon }}</span>
                        </td>
                        
                        <!-- Name -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-semibold text-gray-900">{{ $category->name }}</div>
                            @if($category->description)
                                <div class="text-sm text-gray-600 max-w-xs truncate">{{ $category->description }}</div>
                            @endif
                        </td>
                        
                        <!-- Slug -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <code class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded">{{ $category->slug }}</code>
                        </td>
                        
                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($category->status === 'active')
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                    Active
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        
                        <!-- Campaign Count -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex flex-col items-center">
                                <span class="text-lg font-bold text-gray-900">{{ $category->campaigns_count }}</span>
                                <span class="text-xs text-gray-500">campaigns</span>
                                @if($category->campaigns_count == 0 && $category->status == 'active')
                                    <span class="text-xs text-yellow-600 mt-1">⚠️ No campaigns</span>
                                @endif
                            </div>
                        </td>
                        
                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center gap-2">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-semibold rounded transition">
                                    Edit
                                </a>
                                
                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Are you sure you want to delete this category?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-100 hover:bg-red-200 text-red-800 text-sm font-semibold rounded transition" {{ $category->campaigns_count > 0 ? 'disabled' : '' }}>
                                        Delete
                                    </button>
                                </form>
                            </div>
                            
                            @if($category->campaigns_count > 0)
                                <p class="text-xs text-gray-500 mt-1">Cannot delete (has campaigns)</p>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <p class="text-gray-600 text-lg font-semibold mb-2">No categories yet</p>
                            <p class="text-gray-500 mb-4">Create your first category to get started</p>
                            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Create New Category
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Stats Summary -->
    @if($categories->count() > 0)
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-between items-center text-sm">
                <div class="flex gap-6">
                    <div>
                        <span class="text-gray-600">Total Categories:</span>
                        <span class="font-bold text-gray-900">{{ $categories->count() }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Active:</span>
                        <span class="font-bold text-green-600">{{ $categories->where('status', 'active')->count() }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Inactive:</span>
                        <span class="font-bold text-gray-600">{{ $categories->where('status', 'inactive')->count() }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Empty Categories:</span>
                        <span class="font-bold text-yellow-600">{{ $categories->where('campaigns_count', 0)->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection