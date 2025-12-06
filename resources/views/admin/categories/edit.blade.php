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
            <h2 class="text-xl font-bold text-gray-900">Edit Category</h2>
            <p class="text-sm text-gray-600 mt-1">Update category information</p>
        </div>

        <!-- Warning if has campaigns -->
        @if($category->campaigns_count > 0)
            <div class="px-6 py-4 bg-yellow-50 border-b border-yellow-100">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-yellow-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-yellow-900">Category has active campaigns</p>
                        <p class="text-sm text-yellow-800 mt-1">
                            This category has <strong>{{ $category->campaigns_count }} active campaigns</strong>. 
                            Be careful when changing the name or slug as it may affect campaign visibility.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-900 mb-2">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $category->name) }}"
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
                    value="{{ old('slug', $category->slug) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('slug') border-red-500 @enderror"
                    placeholder="e.g., teknologi-inovasi"
                    required
                >
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">URL-friendly version (lowercase, hyphens only)</p>
                @if($category->campaigns_count > 0)
                    <p class="text-yellow-600 text-sm mt-1">⚠️ Changing slug may affect campaign URLs</p>
                @endif
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
                    value="{{ old('icon', $category->icon) }}"
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
                >{{ old('description', $category->description) }}</textarea>
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
                    <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">
                    @if($category->status == 'active')
                        Active categories are visible to users when creating campaigns
                    @else
                        Inactive categories are hidden from users but data is preserved
                    @endif
                </p>
            </div>

            <!-- Category Info -->
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Category Information</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Created:</span>
                        <span class="font-medium text-gray-900">{{ $category->created_at->format('M d, Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Last Updated:</span>
                        <span class="font-medium text-gray-900">{{ $category->updated_at->format('M d, Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Active Campaigns:</span>
                        <span class="font-medium text-gray-900">{{ $category->campaigns_count }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Current Status:</span>
                        @if($category->status == 'active')
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                        @else
                            <span class="px-2 py-1 bg-gray-200 text-gray-800 text-xs font-semibold rounded-full">Inactive</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition"
                >
                    Update Category
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