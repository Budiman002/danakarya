@extends('layouts.creator')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('creator.campaigns.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to My Campaigns
        </a>
    </div>

    <!-- Campaign Stats Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
        <h3 class="font-semibold text-gray-900 mb-3">Campaign Statistics</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div>
                <p class="text-gray-600">Status</p>
                <p class="font-bold text-gray-900">
                    @if($campaign->status === 'pending')
                        <span class="text-yellow-600">Pending</span>
                    @elseif($campaign->status === 'active')
                        <span class="text-green-600">Active</span>
                    @elseif($campaign->status === 'funded')
                        <span class="text-blue-600">Funded</span>
                    @else
                        <span class="text-gray-600">{{ ucfirst($campaign->status) }}</span>
                    @endif
                </p>
            </div>
            <div>
                <p class="text-gray-600">Current Amount</p>
                <p class="font-bold text-gray-900">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-gray-600">Backers</p>
                <p class="font-bold text-gray-900">{{ $campaign->donations_count }}</p>
            </div>
            <div>
                <p class="text-gray-600">Last Updated</p>
                <p class="font-bold text-gray-900">{{ $campaign->updated_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Warning if Has Donations -->
    @if($campaign->donations_count > 0)
    <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4 mb-6">
        <p class="text-sm text-yellow-800">
            <span class="font-semibold">⚠️ Warning:</span> 
            This campaign has <strong>{{ $campaign->donations_count }} backers</strong>. 
            Major changes (title, target amount, deadline, category) will require admin re-approval.
        </p>
    </div>
    @endif

    <!-- Cannot Edit Warning -->
    @if(in_array($campaign->status, ['funded', 'rejected']))
    <div class="bg-red-50 border border-red-300 rounded-lg p-4 mb-6">
        <p class="text-sm text-red-800">
            <span class="font-semibold">🚫 Cannot Edit:</span> 
            Campaigns with status "{{ ucfirst($campaign->status) }}" cannot be edited.
        </p>
        <a href="{{ route('creator.campaigns.index') }}" class="inline-block mt-3 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
            Back to My Campaigns
        </a>
    </div>
    @else

    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Edit Campaign</h2>
            <p class="text-sm text-gray-600 mt-1">Update your campaign details</p>
        </div>

        <form method="POST" action="{{ route('creator.campaigns.update', $campaign->id) }}" enctype="multipart/form-data" class="p-6 space-y-8">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">📋 Basic Information</h3>
                
                <div class="space-y-4">
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
                            Slug (URL) <span class="text-red-500">*</span>
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
                </div>
            </div>

            <!-- Campaign Details -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">📝 Campaign Details</h3>
                
                <div class="space-y-4">
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                                step="10000"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('target_amount') border-red-500 @enderror"
                                required
                            >
                            @error('target_amount')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="deadline" class="block text-sm font-medium text-gray-900 mb-2">
                                Deadline <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="date" 
                                id="deadline" 
                                name="deadline" 
                                value="{{ old('deadline', \Carbon\Carbon::parse($campaign->deadline)->format('Y-m-d')) }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('deadline') border-red-500 @enderror"
                                required
                            >
                            @error('deadline')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Campaign Image -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">🖼️ Campaign Image</h3>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                    @if($campaign->image)
                        <img src="{{ asset($campaign->image) }}" alt="Current" class="w-full max-w-md h-48 object-cover rounded-lg border border-gray-300">
                    @else
                        <p class="text-gray-500 text-sm">No image uploaded</p>
                    @endif
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-900 mb-2">
                        Replace Image (Optional)
                    </label>
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
                    <p class="text-gray-500 text-sm mt-1">Leave empty to keep current image. Format: JPG, PNG. Max: 2MB</p>
                </div>
            </div>

            <!-- FAQ Section -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">❓ FAQ (Optional)</h3>
                
                <!-- Template FAQs -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                    <h4 class="font-semibold text-gray-900 mb-3">Template FAQs</h4>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="faq_goal" class="block text-sm font-medium text-gray-900 mb-2">
                                📌 Apa tujuan utama campaign ini?
                            </label>
                            <textarea 
                                id="faq_goal" 
                                name="faq_goal" 
                                rows="3"
                                maxlength="500"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent"
                            >{{ old('faq_goal', $campaign->faq_goal) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Max 500 karakter</p>
                        </div>

                        <div>
                            <label for="faq_fund_usage" class="block text-sm font-medium text-gray-900 mb-2">
                                💰 Bagaimana dana yang terkumpul akan digunakan?
                            </label>
                            <textarea 
                                id="faq_fund_usage" 
                                name="faq_fund_usage" 
                                rows="3"
                                maxlength="500"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent"
                            >{{ old('faq_fund_usage', $campaign->faq_fund_usage) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Max 500 karakter</p>
                        </div>

                        <div>
                            <label for="faq_timeline" class="block text-sm font-medium text-gray-900 mb-2">
                                ⏰ Kapan campaign ini akan terealisasi?
                            </label>
                            <textarea 
                                id="faq_timeline" 
                                name="faq_timeline" 
                                rows="3"
                                maxlength="500"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent"
                            >{{ old('faq_timeline', $campaign->faq_timeline) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Max 500 karakter</p>
                        </div>
                    </div>
                </div>

                <!-- Custom FAQs -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-3">Custom FAQs</h4>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="faq_custom_1_question" class="block text-sm font-medium text-gray-700 mb-1">Custom Question 1</label>
                            <input 
                                type="text" 
                                id="faq_custom_1_question" 
                                name="faq_custom_1_question" 
                                value="{{ old('faq_custom_1_question', $campaign->faq_custom_1_question) }}"
                                maxlength="255"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent mb-2"
                            >
                            <textarea 
                                id="faq_custom_1_answer" 
                                name="faq_custom_1_answer" 
                                rows="2"
                                maxlength="500"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent"
                            >{{ old('faq_custom_1_answer', $campaign->faq_custom_1_answer) }}</textarea>
                        </div>

                        <div>
                            <label for="faq_custom_2_question" class="block text-sm font-medium text-gray-700 mb-1">Custom Question 2</label>
                            <input 
                                type="text" 
                                id="faq_custom_2_question" 
                                name="faq_custom_2_question" 
                                value="{{ old('faq_custom_2_question', $campaign->faq_custom_2_question) }}"
                                maxlength="255"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent mb-2"
                            >
                            <textarea 
                                id="faq_custom_2_answer" 
                                name="faq_custom_2_answer" 
                                rows="2"
                                maxlength="500"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent"
                            >{{ old('faq_custom_2_answer', $campaign->faq_custom_2_answer) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex gap-3 pt-4 border-t">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition"
                >
                    Update Campaign
                </button>
                <a 
                    href="{{ route('creator.campaigns.index') }}" 
                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
    @endif
</div>

<script>
// Auto-generate slug from title
document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slug = title.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim();
    document.getElementById('slug').value = slug;
});
</script>
@endsection