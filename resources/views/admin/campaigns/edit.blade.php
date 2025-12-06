@extends('layouts.admin')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('admin.campaigns.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Campaigns
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Edit Campaign</h2>
            <p class="text-sm text-gray-600 mt-1">Update campaign information</p>
        </div>

        @if($campaign->donations_count > 0)
            <div class="px-6 py-4 bg-yellow-50 border-b border-yellow-100">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-yellow-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-yellow-900">Campaign has active donations</p>
                        <p class="text-sm text-yellow-800 mt-1">
                            This campaign has <strong>{{ $campaign->donations_count }} donations</strong>. 
                            Be careful when changing critical information.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.campaigns.update', $campaign->id) }}" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-900 mb-2">
                    Campaign Title <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $campaign->title) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('title') border-red-500 @enderror"
                    required
                >
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-900 mb-2">
                    Slug <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="slug" 
                    name="slug" 
                    value="{{ old('slug', $campaign->slug) }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('slug') border-red-500 @enderror"
                    required
                >
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-900 mb-2">
                    Category <span class="text-red-500">*</span>
                </label>
                <select 
                    id="category_id" 
                    name="category_id"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('category_id') border-red-500 @enderror"
                    required
                >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $campaign->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->icon }} {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-900 mb-2">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="8"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('description') border-red-500 @enderror"
                    required
                >{{ old('description', $campaign->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="target_amount" class="block text-sm font-medium text-gray-900 mb-2">
                        Target Amount (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="target_amount" 
                        name="target_amount" 
                        value="{{ old('target_amount', $campaign->target_amount) }}"
                        min="100000"
                        step="1000"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('target_amount') border-red-500 @enderror"
                        required
                    >
                    @error('target_amount')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Minimum: Rp 100,000</p>
                </div>

                <div>
                    <label for="deadline" class="block text-sm font-medium text-gray-900 mb-2">
                        Deadline <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="deadline" 
                        name="deadline" 
                        value="{{ old('deadline', $campaign->deadline) }}"
                        min="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('deadline') border-red-500 @enderror"
                        required
                    >
                    @error('deadline')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-900 mb-2">
                    Campaign Image
                </label>
                
                @if($campaign->image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                        <img src="{{ asset($campaign->image) }}" alt="{{ $campaign->title }}" class="w-64 h-48 object-cover rounded-lg">
                    </div>
                @endif

                <input 
                    type="file" 
                    id="image" 
                    name="image" 
                    accept="image/jpeg,image/jpg,image/png"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('image') border-red-500 @enderror"
                >
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Leave empty to keep current image. Max 2MB (JPG, PNG)</p>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-900 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select 
                    id="status" 
                    name="status"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('status') border-red-500 @enderror"
                    required
                >
                    <option value="pending" {{ old('status', $campaign->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ old('status', $campaign->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="funded" {{ old('status', $campaign->status) == 'funded' ? 'selected' : '' }}>Funded</option>
                    <option value="rejected" {{ old('status', $campaign->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="cancelled" {{ old('status', $campaign->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Campaign Stats</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Current Amount:</span>
                        <span class="font-medium text-gray-900">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Donations:</span>
                        <span class="font-medium text-gray-900">{{ $campaign->donations_count }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Created:</span>
                        <span class="font-medium text-gray-900">{{ $campaign->created_at->format('M d, Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Last Updated:</span>
                        <span class="font-medium text-gray-900">{{ $campaign->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition"
                >
                    Update Campaign
                </button>
                <a 
                    href="{{ route('admin.campaigns.index') }}" 
                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection