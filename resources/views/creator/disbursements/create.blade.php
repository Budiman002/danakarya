@extends('layouts.creator')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <div>
        <a href="{{ route('creator.campaigns.index') }}" class="inline-flex items-center text-[#2D7A67] hover:text-[#1A5647] font-semibold">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Campaigns
        </a>
    </div>

    <!-- Campaign Info Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $campaign->title }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-gray-600">Total Raised</p>
                <p class="text-lg font-semibold text-gray-900">Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Platform Fee (5%)</p>
                <p class="text-lg font-semibold text-red-600">- Rp {{ number_format($platformFee, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">You Will Receive</p>
                <p class="text-lg font-semibold text-green-600">Rp {{ number_format($netAmount, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Withdrawal Request Form -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6">Bank Account Details</h3>

        <form method="POST" action="{{ route('creator.disbursements.store', $campaign->id) }}" class="space-y-6">
            @csrf

            <!-- Bank Name -->
            <div>
                <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">Bank Name *</label>
                <select
                    name="bank_name"
                    id="bank_name"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('bank_name') border-red-500 @enderror"
                >
                    <option value="">-- Select Bank --</option>
                    <option value="BCA - Bank Central Asia" {{ old('bank_name') == 'BCA - Bank Central Asia' ? 'selected' : '' }}>BCA - Bank Central Asia</option>
                    <option value="BRI - Bank Rakyat Indonesia" {{ old('bank_name') == 'BRI - Bank Rakyat Indonesia' ? 'selected' : '' }}>BRI - Bank Rakyat Indonesia</option>
                    <option value="BNI - Bank Negara Indonesia" {{ old('bank_name') == 'BNI - Bank Negara Indonesia' ? 'selected' : '' }}>BNI - Bank Negara Indonesia</option>
                    <option value="Mandiri - Bank Mandiri" {{ old('bank_name') == 'Mandiri - Bank Mandiri' ? 'selected' : '' }}>Mandiri - Bank Mandiri</option>
                    <option value="BTN - Bank Tabungan Negara" {{ old('bank_name') == 'BTN - Bank Tabungan Negara' ? 'selected' : '' }}>BTN - Bank Tabungan Negara</option>
                    <option value="CIMB Niaga" {{ old('bank_name') == 'CIMB Niaga' ? 'selected' : '' }}>CIMB Niaga</option>
                    <option value="Permata Bank" {{ old('bank_name') == 'Permata Bank' ? 'selected' : '' }}>Permata Bank</option>
                    <option value="Danamon" {{ old('bank_name') == 'Danamon' ? 'selected' : '' }}>Danamon</option>
                    <option value="Panin Bank" {{ old('bank_name') == 'Panin Bank' ? 'selected' : '' }}>Panin Bank</option>
                    <option value="OCBC NISP" {{ old('bank_name') == 'OCBC NISP' ? 'selected' : '' }}>OCBC NISP</option>
                    <option value="Maybank Indonesia" {{ old('bank_name') == 'Maybank Indonesia' ? 'selected' : '' }}>Maybank Indonesia</option>
                    <option value="Bank Syariah Indonesia (BSI)" {{ old('bank_name') == 'Bank Syariah Indonesia (BSI)' ? 'selected' : '' }}>Bank Syariah Indonesia (BSI)</option>
                    <option value="BCA Syariah" {{ old('bank_name') == 'BCA Syariah' ? 'selected' : '' }}>BCA Syariah</option>
                    <option value="Muamalat" {{ old('bank_name') == 'Muamalat' ? 'selected' : '' }}>Muamalat</option>
                    <option value="BTPN" {{ old('bank_name') == 'BTPN' ? 'selected' : '' }}>BTPN</option>
                    <option value="Jenius (BTPN)" {{ old('bank_name') == 'Jenius (BTPN)' ? 'selected' : '' }}>Jenius (BTPN)</option>
                    <option value="Bank Jago" {{ old('bank_name') == 'Bank Jago' ? 'selected' : '' }}>Bank Jago</option>
                    <option value="SeaBank" {{ old('bank_name') == 'SeaBank' ? 'selected' : '' }}>SeaBank</option>
                    <option value="Bank Neo Commerce" {{ old('bank_name') == 'Bank Neo Commerce' ? 'selected' : '' }}>Bank Neo Commerce</option>
                    <option value="Blu by BCA Digital" {{ old('bank_name') == 'Blu by BCA Digital' ? 'selected' : '' }}>Blu by BCA Digital</option>
                    <option value="Allo Bank" {{ old('bank_name') == 'Allo Bank' ? 'selected' : '' }}>Allo Bank</option>
                    <option value="Other Bank" {{ old('bank_name') == 'Other Bank' ? 'selected' : '' }}>Other Bank</option>
                </select>
                @error('bank_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Account Number -->
            <div>
                <label for="account_number" class="block text-sm font-medium text-gray-700 mb-2">Account Number *</label>
                <input
                    type="text"
                    name="account_number"
                    id="account_number"
                    value="{{ old('account_number') }}"
                    required
                    placeholder="e.g., 1234567890"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('account_number') border-red-500 @enderror"
                >
                @error('account_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Account Holder Name -->
            <div>
                <label for="account_holder" class="block text-sm font-medium text-gray-700 mb-2">Account Holder Name *</label>
                <input
                    type="text"
                    name="account_holder"
                    id="account_holder"
                    value="{{ old('account_holder', Auth::user()->name) }}"
                    required
                    placeholder="Name as shown on bank account"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('account_holder') border-red-500 @enderror"
                >
                @error('account_holder')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Creator Notes -->
            <div>
                <label for="creator_notes" class="block text-sm font-medium text-gray-700 mb-2">Additional Notes (Optional)</label>
                <textarea
                    name="creator_notes"
                    id="creator_notes"
                    rows="4"
                    placeholder="Any additional information for the admin..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent @error('creator_notes') border-red-500 @enderror"
                >{{ old('creator_notes') }}</textarea>
                @error('creator_notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Important Notice -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="text-sm font-semibold text-yellow-800 mb-1">Important Notice</h4>
                        <ul class="text-sm text-yellow-700 space-y-1 list-disc list-inside">
                            <li>Please ensure all bank account details are correct</li>
                            <li>Your withdrawal request will be reviewed by our admin team</li>
                            <li>The process may take 3-5 business days</li>
                            <li>You will be notified once your request is approved or rejected</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-4">
                <a
                    href="{{ route('creator.campaigns.index') }}"
                    class="px-6 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition"
                >
                    Cancel
                </a>
                <button
                    type="submit"
                    class="px-6 py-2 bg-[#2D7A67] hover:bg-[#1A5647] text-white font-semibold rounded-lg transition"
                >
                    Submit Withdrawal Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
