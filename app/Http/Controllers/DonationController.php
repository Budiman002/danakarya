<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class DonationController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function create($slug)
    {
        $campaign = Campaign::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();
        
        return view('donations.create', [
            'title' => 'Donate to ' . $campaign->title,
            'campaign' => $campaign,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'campaign_id' => ['required', 'exists:campaigns,id'],
            'amount' => ['required', 'numeric', 'min:10000'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'message' => ['nullable', 'string', 'max:500'],
        ]);

        $campaign = Campaign::findOrFail($validated['campaign_id']);

        if ($campaign->status !== 'active') {
            return response()->json([
                'error' => 'Campaign is not active'
            ], 400);
        }

        $donation = Donation::create([
            'user_id' => Auth::id(),
            'campaign_id' => $validated['campaign_id'],
            'amount' => $validated['amount'],
            'status' => 'confirmed',
            'payment_method' => 'midtrans',
            'message' => $validated['message'],
        ]);

        $campaign->increment('current_amount', $validated['amount']);

        if ($campaign->current_amount >= $campaign->target_amount) {
            $campaign->update(['status' => 'funded']);
        }

        $donation->load(['campaign.user', 'user']);

        NotificationService::newDonation($donation);
        NotificationService::donationSuccess($donation);

        return response()->json([
            'success' => true,
            'donation_id' => $donation->id,
            'message' => 'Donation successful!',
        ]);
    }

    public function success($id)
    {
        $donation = Donation::with(['campaign', 'user'])->findOrFail($id);
        
        return view('donations.success', [
            'title' => 'Thank You!',
            'donation' => $donation,
        ]);
    }
}