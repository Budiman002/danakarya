@extends('layouts.admin')

@section('content')
<div class="max-w-2xl">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Categories
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Create New Category</h2>
            <p class="text-sm text-gray-600 mt-1">Add a new category for campaign classification</p>
        </div>

        <!-- Best Practices Info -->
        <div class="px-6 py-4 bg-blue-50 border-b border-blue-100">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-sm font-semibold text-blue-900">Best Practices:</p>
                    <ul class="text-sm text-blue-800 mt-1 space-y-1">
                        <li>• Keep categories broad (e.g., "Teknologi" not "AI Blockchain IoT")</li>
                        <li>• Check existing categories before creating new ones</li>
                        <li>• Use 10-15 active categories maximum for best UX</li>
                        <li>• Choose a relevant emoji icon that represents the category</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.categories.store') }}" class="p-6 space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-900 mb-2">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="e.g., Teknologi & Inovasi"
                    required
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Keep it broad and easy to understand</p>
            </div>

            <!-- Slug -->
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-900 mb-2">
                    Slug <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="slug" 
                    name="slug" 
                    value="{{ old('slug') }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('slug') border-red-500 @enderror"
                    placeholder="e.g., teknologi-inovasi"
                    required
                >
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">URL-friendly version (lowercase, hyphens only). Auto-generated from name if left empty.</p>
            </div>

            <!-- Icon -->
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-900 mb-2">
                    Icon (Emoji) <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="icon" 
                    name="icon" 
                    value="{{ old('icon') }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('icon') border-red-500 @enderror"
                    placeholder="e.g., 💻 🎨 🏪 📚 🏥 🌱"
                    maxlength="10"
                    required
                >
                @error('icon')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Use a single emoji that represents the category</p>
                <div class="mt-2 flex flex-wrap gap-2">
                    <button type="button" onclick="document.getElementById('icon').value='🎨'" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-2xl">🎨</button>
                    <button type="button" onclick="document.getElementById('icon').value='🏪'" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-2xl">🏪</button>
                    <button type="button" onclick="document.getElementById('icon').value='💻'" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-2xl">💻</button>
                    <button type="button" onclick="document.getElementById('icon').value='📚'" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-2xl">📚</button>
                    <button type="button" onclick="document.getElementById('icon').value='🏥'" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-2xl">🏥</button>
                    <button type="button" onclick="document.getElementById('icon').value='🌱'" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-2xl">🌱</button>
                    <button type="button" onclick="document.getElementById('icon').value='🏋️'" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-2xl">🏋️</button>
                    <button type="button" onclick="document.getElementById('icon').value='🍔'" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-2xl">🍔</button>
                    <button type="button" onclick="document.getElementById('icon').value='🎮'" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-2xl">🎮</button>
                    <button type="button" onclick="document.getElementById('icon').value='👗'" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded text-2xl">👗</button>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-900 mb-2">
                    Description <span class="text-gray-500 text-xs">(Optional)</span>
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('description') border-red-500 @enderror"
                    placeholder="Brief description of this category..."
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Optional description for internal reference</p>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-900 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select 
                    id="status" 
                    name="status"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('status') border-red-500 @enderror"
                    required
                >
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Active categories are visible to users when creating campaigns</p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition"
                >
                    Create Category
                </button>
                <a 
                    href="{{ route('admin.categories.index') }}" 
                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Auto-generate slug from name -->
<script>
    document.getElementById('name').addEventListener('input', function(e) {
        const name = e.target.value;
        const slug = name
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('slug').value = slug;
    });
</script>
@endsection