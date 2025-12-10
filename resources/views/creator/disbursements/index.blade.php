@extends('layouts.creator')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Withdrawal History</h1>
            <p class="text-gray-600 mt-1">Track all your withdrawal requests</p>
        </div>
    </div>

    <!-- Withdrawal Requests Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campaign</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Platform Fee</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Net Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bank Account</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($disbursements as $disbursement)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $disbursement->campaign->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Rp {{ number_format($disbursement->amount, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-red-600">- Rp {{ number_format($disbursement->platform_fee, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-green-600">Rp {{ number_format($disbursement->net_amount, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $disbursement->bank_name }}</div>
                                <div class="text-xs text-gray-500">{{ $disbursement->account_number }}</div>
                                <div class="text-xs text-gray-500">{{ $disbursement->account_holder }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($disbursement->status === 'pending')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending Review
                                    </span>
                                @elseif($disbursement->status === 'approved')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Approved
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $disbursement->created_at->format('M d, Y') }}
                                @if($disbursement->approved_at)
                                    <div class="text-xs text-gray-400">
                                        {{ $disbursement->status === 'approved' ? 'Approved' : 'Rejected' }}: {{ $disbursement->approved_at->format('M d, Y') }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @if($disbursement->creator_notes || $disbursement->admin_note)
                        <tr class="bg-gray-50">
                            <td colspan="7" class="px-6 py-3">
                                @if($disbursement->creator_notes)
                                <div class="mb-2">
                                    <span class="text-xs font-semibold text-gray-700">Your Notes:</span>
                                    <p class="text-sm text-gray-600 mt-1">{{ $disbursement->creator_notes }}</p>
                                </div>
                                @endif
                                @if($disbursement->admin_note)
                                <div>
                                    <span class="text-xs font-semibold text-gray-700">Admin Response:</span>
                                    <p class="text-sm text-gray-600 mt-1">{{ $disbursement->admin_note }}</p>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-600">No withdrawal requests yet</p>
                                <p class="text-xs text-gray-500 mt-1">Your withdrawal requests will appear here once submitted</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($disbursements->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $disbursements->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
