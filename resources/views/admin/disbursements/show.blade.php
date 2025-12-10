@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <div>
        <a href="{{ route('admin.disbursements.index') }}" class="inline-flex items-center text-[#2D7A67] hover:text-[#1A5647] font-semibold">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Withdrawal Requests
        </a>
    </div>

    <!-- Status Alert -->
    @if($disbursement->status === 'approved')
    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h4 class="text-sm font-semibold text-green-800">This withdrawal request has been approved</h4>
                <p class="text-sm text-green-700">Approved on {{ $disbursement->approved_at->format('F d, Y \a\t h:i A') }}</p>
            </div>
        </div>
    </div>
    @elseif($disbursement->status === 'rejected')
    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h4 class="text-sm font-semibold text-red-800">This withdrawal request has been rejected</h4>
                <p class="text-sm text-red-700">Rejected on {{ $disbursement->approved_at->format('F d, Y \a\t h:i A') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Main Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Creator Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Creator Information</h3>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-[#7DD3C0] rounded-full flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">{{ substr($campaign->user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ $campaign->user->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $campaign->user->email }}</p>
                        <p class="text-sm text-gray-500 mt-1">Member since {{ $campaign->user->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Campaign Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Campaign Details</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Campaign Title</p>
                        <p class="font-semibold text-gray-900">{{ $campaign->title }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Target Amount</p>
                            <p class="font-semibold text-gray-900">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Raised</p>
                            <p class="font-semibold text-green-600">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Backers</p>
                            <p class="font-semibold text-gray-900">{{ $totalBackers }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Average Donation</p>
                            <p class="font-semibold text-gray-900">Rp {{ number_format($averageDonation, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bank Account Details -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Bank Account Details</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Bank Name</p>
                        <p class="font-semibold text-gray-900">{{ $disbursement->bank_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Account Number</p>
                        <p class="font-semibold text-gray-900">{{ $disbursement->account_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Account Holder Name</p>
                        <p class="font-semibold text-gray-900">{{ $disbursement->account_holder }}</p>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($disbursement->creator_notes || $disbursement->admin_note)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Notes</h3>
                <div class="space-y-4">
                    @if($disbursement->creator_notes)
                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-1">Creator's Notes</p>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-sm text-gray-700">{{ $disbursement->creator_notes }}</p>
                        </div>
                    </div>
                    @endif
                    @if($disbursement->admin_note)
                    <div>
                        <p class="text-sm font-semibold text-gray-700 mb-1">Admin Response</p>
                        <div class="bg-blue-50 rounded-lg p-3">
                            <p class="text-sm text-gray-700">{{ $disbursement->admin_note }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column - Amount Summary & Actions -->
        <div class="space-y-6">
            <!-- Amount Summary -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Amount Summary</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Amount</span>
                        <span class="font-semibold text-gray-900">Rp {{ number_format($disbursement->amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Platform Fee (5%)</span>
                        <span class="font-semibold text-red-600">- Rp {{ number_format($disbursement->platform_fee, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3">
                        <div class="flex justify-between items-center">
                            <span class="text-base font-semibold text-gray-900">Net Amount</span>
                            <span class="text-lg font-bold text-green-600">Rp {{ number_format($disbursement->net_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Request Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Request Information</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Request Date</p>
                        <p class="font-semibold text-gray-900">{{ $disbursement->created_at->format('F d, Y') }}</p>
                        <p class="text-xs text-gray-500">{{ $disbursement->created_at->format('h:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        @if($disbursement->status === 'pending')
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending Review
                            </span>
                        @elseif($disbursement->status === 'approved')
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                Approved
                            </span>
                        @else
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                Rejected
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            @if($disbursement->status === 'pending')
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>

                <!-- Approve Form -->
                <form method="POST" action="{{ route('admin.disbursements.approve', $disbursement->id) }}" class="mb-4">
                    @csrf
                    <div class="mb-4">
                        <label for="approve_note" class="block text-sm font-medium text-gray-700 mb-2">Admin Note (Optional)</label>
                        <textarea
                            name="admin_note"
                            id="approve_note"
                            rows="3"
                            placeholder="Add a note for the creator..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        class="w-full px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition"
                        onclick="return confirm('Are you sure you want to approve this withdrawal request?')"
                    >
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Approve Request
                    </button>
                </form>

                <!-- Reject Form -->
                <form method="POST" action="{{ route('admin.disbursements.reject', $disbursement->id) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="reject_note" class="block text-sm font-medium text-gray-700 mb-2">Rejection Reason *</label>
                        <textarea
                            name="admin_note"
                            id="reject_note"
                            rows="3"
                            required
                            placeholder="Please provide a reason for rejection..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        class="w-full px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition"
                        onclick="return confirm('Are you sure you want to reject this withdrawal request?')"
                    >
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reject Request
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
