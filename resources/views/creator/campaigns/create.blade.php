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

    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Create New Campaign</h2>
            <p class="text-sm text-gray-600 mt-1">Fill in the details to create your crowdfunding campaign</p>
        </div>

        <form method="POST" action="{{ route('creator.campaigns.store') }}" enctype="multipart/form-data" class="p-6 space-y-8">
            @csrf

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
                            value="{{ old('title') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('title') border-red-500 @enderror"
                            placeholder="e.g., Bantu UMKM Warung Makan Ibu Sri Berkembang"
                            required
                        >
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1">Buat judul yang menarik dan jelas (max 255 karakter)</p>
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-900 mb-2">
                            Slug (URL) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="slug" 
                            name="slug" 
                            value="{{ old('slug') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('slug') border-red-500 @enderror"
                            placeholder="warung-makan-ibu-sri"
                            required
                        >
                        @error('slug')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1">URL campaign Anda (otomatis terisi dari title, bisa diedit)</p>
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
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                            placeholder="Jelaskan detail campaign Anda... (minimal 100 karakter)"
                            required
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1">Minimal 100 karakter. Jelaskan latar belakang, tujuan, dan rencana campaign Anda.</p>
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
                                value="{{ old('target_amount') }}"
                                min="100000"
                                step="10000"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('target_amount') border-red-500 @enderror"
                                placeholder="5000000"
                                required
                            >
                            @error('target_amount')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-sm mt-1">Minimal Rp 100,000</p>
                        </div>

                        <div>
                            <label for="deadline" class="block text-sm font-medium text-gray-900 mb-2">
                                Deadline <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="date" 
                                id="deadline" 
                                name="deadline" 
                                value="{{ old('deadline') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('deadline') border-red-500 @enderror"
                                required
                            >
                            @error('deadline')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-sm mt-1">Tanggal berakhirnya campaign (minimal besok)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Campaign Image -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">🖼️ Campaign Image</h3>
                
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-900 mb-2">
                        Upload Image <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="file" 
                        id="image" 
                        name="image" 
                        accept="image/jpeg,image/jpg,image/png"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('image') border-red-500 @enderror"
                        required
                    >
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Format: JPG, PNG. Max size: 2MB. Recommended: 1200x600px</p>
                    
                    <div id="imagePreview" class="mt-4 hidden">
                        <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                        <img id="preview" src="" alt="Preview" class="max-w-md rounded-lg border border-gray-300">
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">❓ Frequently Asked Questions (Optional)</h3>
                <p class="text-sm text-gray-600 mb-4">Bantu calon backers memahami campaign Anda dengan menjawab pertanyaan umum</p>
                
                <!-- Template FAQs -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                    <h4 class="font-semibold text-gray-900 mb-3">Template FAQs (Recommended)</h4>
                    
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
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('faq_goal') border-red-500 @enderror"
                                placeholder="Jelaskan tujuan utama dari campaign Anda..."
                            >{{ old('faq_goal') }}</textarea>
                            @error('faq_goal')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
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
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('faq_fund_usage') border-red-500 @enderror"
                                placeholder="Jelaskan detail penggunaan dana, misalnya: 40% bahan baku, 30% peralatan, 30% operasional..."
                            >{{ old('faq_fund_usage') }}</textarea>
                            @error('faq_fund_usage')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
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
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('faq_timeline') border-red-500 @enderror"
                                placeholder="Jelaskan timeline realisasi campaign, misalnya: Bulan 1-2 persiapan, Bulan 3-4 eksekusi..."
                            >{{ old('faq_timeline') }}</textarea>
                            @error('faq_timeline')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Max 500 karakter</p>
                        </div>
                    </div>
                </div>

                <!-- Custom FAQs -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-3">Custom FAQs (Optional)</h4>
                    <p class="text-sm text-gray-600 mb-4">Tambahkan hingga 2 pertanyaan tambahan dengan jawaban Anda sendiri</p>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="faq_custom_1_question" class="block text-sm font-medium text-gray-700 mb-1">Custom Question 1</label>
                            <input 
                                type="text" 
                                id="faq_custom_1_question" 
                                name="faq_custom_1_question" 
                                value="{{ old('faq_custom_1_question') }}"
                                maxlength="255"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent mb-2 @error('faq_custom_1_question') border-red-500 @enderror"
                                placeholder="e.g., Apa yang membuat campaign ini berbeda?"
                            >
                            <textarea 
                                id="faq_custom_1_answer" 
                                name="faq_custom_1_answer" 
                                rows="2"
                                maxlength="500"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('faq_custom_1_answer') border-red-500 @enderror"
                                placeholder="Jawaban untuk pertanyaan custom 1..."
                            >{{ old('faq_custom_1_answer') }}</textarea>
                            @error('faq_custom_1_question')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            @error('faq_custom_1_answer')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="faq_custom_2_question" class="block text-sm font-medium text-gray-700 mb-1">Custom Question 2</label>
                            <input 
                                type="text" 
                                id="faq_custom_2_question" 
                                name="faq_custom_2_question" 
                                value="{{ old('faq_custom_2_question') }}"
                                maxlength="255"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent mb-2 @error('faq_custom_2_question') border-red-500 @enderror"
                                placeholder="e.g., Bagaimana cara mendukung campaign ini selain donasi?"
                            >
                            <textarea 
                                id="faq_custom_2_answer" 
                                name="faq_custom_2_answer" 
                                rows="2"
                                maxlength="500"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('faq_custom_2_answer') border-red-500 @enderror"
                                placeholder="Jawaban untuk pertanyaan custom 2..."
                            >{{ old('faq_custom_2_answer') }}</textarea>
                            @error('faq_custom_2_question')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            @error('faq_custom_2_answer')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
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
                    Submit for Review
                </button>
                <a 
                    href="{{ route('creator.campaigns.index') }}" 
                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition"
                >
                    Cancel
                </a>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-sm text-yellow-800">
                    <span class="font-semibold">ℹ️ Note:</span> Campaign Anda akan di-review oleh admin sebelum dipublikasikan. Pastikan semua informasi sudah benar.
                </p>
            </div>
        </form>
    </div>
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

// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection