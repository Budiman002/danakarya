@extends('layouts.public')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('campaigns.show', $campaign->slug) }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Campaign
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Campaign Summary -->
            <div class="bg-gradient-to-r from-[#2D7A67] to-[#7DD3C0] p-6 text-white">
                <p class="text-sm opacity-90 mb-2">You're supporting</p>
                <h1 class="text-2xl font-bold mb-2">{{ $campaign->title }}</h1>
                <p class="text-sm opacity-90">by {{ $campaign->user->name }}</p>
            </div>

            <!-- Donation Form -->
            <form id="donation-form" class="p-6 space-y-6">
                @csrf

                <!-- Amount Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-3">Select Amount</label>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-4">
                        <button type="button" onclick="selectAmount(50000)" class="amount-btn px-4 py-3 border-2 border-gray-300 rounded-lg hover:border-[#2D7A67] hover:bg-[#2D7A67] hover:text-white transition font-semibold">
                            Rp 50.000
                        </button>
                        <button type="button" onclick="selectAmount(100000)" class="amount-btn px-4 py-3 border-2 border-gray-300 rounded-lg hover:border-[#2D7A67] hover:bg-[#2D7A67] hover:text-white transition font-semibold">
                            Rp 100.000
                        </button>
                        <button type="button" onclick="selectAmount(250000)" class="amount-btn px-4 py-3 border-2 border-gray-300 rounded-lg hover:border-[#2D7A67] hover:bg-[#2D7A67] hover:text-white transition font-semibold">
                            Rp 250.000
                        </button>
                        <button type="button" onclick="selectAmount(500000)" class="amount-btn px-4 py-3 border-2 border-gray-300 rounded-lg hover:border-[#2D7A67] hover:bg-[#2D7A67] hover:text-white transition font-semibold">
                            Rp 500.000
                        </button>
                        <button type="button" onclick="selectAmount(1000000)" class="amount-btn px-4 py-3 border-2 border-gray-300 rounded-lg hover:border-[#2D7A67] hover:bg-[#2D7A67] hover:text-white transition font-semibold">
                            Rp 1.000.000
                        </button>
                        <button type="button" onclick="selectCustomAmount()" class="amount-btn px-4 py-3 border-2 border-[#F5A623] text-[#F5A623] rounded-lg hover:bg-[#F5A623] hover:text-white transition font-semibold">
                            Custom
                        </button>
                    </div>

                    <div id="custom-amount-input" class="hidden">
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Enter Custom Amount</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                            <input 
                                type="number" 
                                id="amount" 
                                name="amount" 
                                min="10000"
                                step="1000"
                                class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent"
                                placeholder="Minimum Rp 10.000"
                            >
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Minimum donation: Rp 10.000</p>
                    </div>

                    <div id="selected-amount-display" class="hidden mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-gray-700">Selected Amount:</p>
                        <p class="text-2xl font-bold text-[#2D7A67]" id="display-amount">Rp 0</p>
                    </div>
                </div>

                <!-- Donor Information -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Your Information</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-900 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ Auth::check() ? Auth::user()->name : old('name') }}"
                                {{ Auth::check() ? 'readonly' : '' }}
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent {{ Auth::check() ? 'bg-gray-50' : '' }}"
                                required
                            >
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
                                {{ Auth::check() ? 'readonly' : '' }}
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent {{ Auth::check() ? 'bg-gray-50' : '' }}"
                                required
                            >
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-900 mb-2">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                value="{{ old('phone') }}"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent"
                                placeholder="08123456789"
                                required
                            >
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-900 mb-2">
                                Message to Creator (Optional)
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="3"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#2D7A67] focus:border-transparent"
                                placeholder="Write a message of support..."
                            >{{ old('message') }}</textarea>
                        </div>
                    </div>
                </div>

                            <button 
                            type="submit" 
                            id="pay-button"
                            class="w-full px-6 py-4 bg-[#F5A623] hover:bg-[#E09612] text-white font-bold rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled    
                            >
                            Continue to Payment
                        </button>
                    <p class="text-xs text-gray-500 text-center mt-3">You'll be redirected to Midtrans secure payment page</p>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
let selectedAmount = 0;

function selectAmount(amount) {
    selectedAmount = amount;
    
    document.getElementById('custom-amount-input').classList.add('hidden');
    document.getElementById('amount').value = '';
    
    document.querySelectorAll('.amount-btn').forEach(btn => {
        btn.classList.remove('border-[#2D7A67]', 'bg-[#2D7A67]', 'text-white');
        btn.classList.add('border-gray-300');
    });
    
    event.target.classList.remove('border-gray-300');
    event.target.classList.add('border-[#2D7A67]', 'bg-[#2D7A67]', 'text-white');
    
    showSelectedAmount(amount);
    
    document.getElementById('pay-button').disabled = false;
}

function selectCustomAmount() {
    document.querySelectorAll('.amount-btn').forEach(btn => {
        btn.classList.remove('border-[#2D7A67]', 'bg-[#2D7A67]', 'text-white');
        btn.classList.add('border-gray-300');
    });
    
    event.target.classList.remove('border-gray-300');
    event.target.classList.add('border-[#F5A623]', 'bg-[#F5A623]', 'text-white');
    
    document.getElementById('custom-amount-input').classList.remove('hidden');
    document.getElementById('selected-amount-display').classList.add('hidden');
    document.getElementById('amount').focus();
    
    document.getElementById('pay-button').disabled = true;
}

document.getElementById('amount').addEventListener('input', function() {
    const amount = parseInt(this.value) || 0;
    
    if (amount >= 10000) {
        selectedAmount = amount;
        showSelectedAmount(amount);
        document.getElementById('pay-button').disabled = false;
    } else {
        selectedAmount = 0;
        document.getElementById('selected-amount-display').classList.add('hidden');
        document.getElementById('pay-button').disabled = true;
    }
});

function showSelectedAmount(amount) {
    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    });
    
    document.getElementById('display-amount').textContent = formatter.format(amount);
    document.getElementById('selected-amount-display').classList.remove('hidden');
}

document.getElementById('donation-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (selectedAmount < 10000) {
        alert('Please select or enter a donation amount (minimum Rp 10.000)');
        return;
    }

    const submitButton = document.getElementById('pay-button');
    const originalText = submitButton.textContent;
    
    submitButton.disabled = true;
    submitButton.textContent = 'Processing...';
    
    const formData = new FormData(this);
    formData.append('campaign_id', {{ $campaign->id }});
    formData.append('amount', selectedAmount);
    
    // ✅ MOCK PAYMENT - Direct submission
    fetch('{{ route('donations.store') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert('Error: ' + data.error);
            submitButton.disabled = false;
            submitButton.textContent = originalText;
            return;
        }
        
        // ✅ Direct redirect to success page (no payment popup!)
        if (data.success) {
            window.location.href = '{{ url('/donations') }}/' + data.donation_id + '/success';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
        submitButton.disabled = false;
        submitButton.textContent = originalText;
    });
});
</script>
@endsection