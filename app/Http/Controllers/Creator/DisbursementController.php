<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Disbursement;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DisbursementController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all disbursements for user's campaigns
        $disbursements = Disbursement::whereHas('campaign', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with('campaign')
        ->recent()
        ->paginate(15);

        return view('creator.disbursements.index', [
            'title' => 'Withdrawal History',
            'subtitle' => 'View your withdrawal requests',
            'disbursements' => $disbursements,
        ]);
    }

    public function create($campaignId)
    {
        $user = Auth::user();

        // Get campaign and verify ownership
        $campaign = Campaign::where('id', $campaignId)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Check if campaign is funded (reached target)
        if ($campaign->current_amount < $campaign->target_amount) {
            return redirect()->route('creator.campaigns.index')
                ->with('error', 'Campaign has not reached its funding goal yet.');
        }

        // Check if there's already a pending disbursement for this campaign
        $pendingDisbursement = Disbursement::where('campaign_id', $campaign->id)
            ->where('status', 'pending')
            ->first();

        if ($pendingDisbursement) {
            return redirect()->route('creator.disbursements.index')
                ->with('error', 'There is already a pending withdrawal request for this campaign.');
        }

        // Calculate amounts
        $totalAmount = $campaign->current_amount;
        $platformFee = $totalAmount * 0.05; // 5% platform fee
        $netAmount = $totalAmount - $platformFee;

        return view('creator.disbursements.create', [
            'title' => 'Request Withdrawal',
            'subtitle' => $campaign->title,
            'campaign' => $campaign,
            'totalAmount' => $totalAmount,
            'platformFee' => $platformFee,
            'netAmount' => $netAmount,
        ]);
    }

    public function store(Request $request, $campaignId)
    {
        $user = Auth::user();

        // Get campaign and verify ownership
        $campaign = Campaign::where('id', $campaignId)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Validate request
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_holder' => 'required|string|max:255',
            'creator_notes' => 'nullable|string|max:1000',
        ]);

        // Check if campaign is funded
        if ($campaign->current_amount < $campaign->target_amount) {
            return back()->with('error', 'Campaign has not reached its funding goal yet.');
        }

        // Check for pending disbursement
        $pendingDisbursement = Disbursement::where('campaign_id', $campaign->id)
            ->where('status', 'pending')
            ->first();

        if ($pendingDisbursement) {
            return redirect()->route('creator.disbursements.index')
                ->with('error', 'There is already a pending withdrawal request for this campaign.');
        }

        // Calculate amounts
        $totalAmount = $campaign->current_amount;
        $platformFee = $totalAmount * 0.05; // 5% platform fee
        $netAmount = $totalAmount - $platformFee;

        // Create disbursement request
        $disbursement = Disbursement::create([
            'campaign_id' => $campaign->id,
            'amount' => $totalAmount,
            'platform_fee' => $platformFee,
            'net_amount' => $netAmount,
            'bank_name' => $validated['bank_name'],
            'account_number' => $validated['account_number'],
            'account_holder' => $validated['account_holder'],
            'creator_notes' => $validated['creator_notes'] ?? null,
            'status' => 'pending',
        ]);

        // Send notification to admins
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            NotificationService::send(
                $admin,
                'new_withdrawal_request',
                '💰 New Withdrawal Request',
                "{$user->name} has requested withdrawal for campaign \"{$campaign->title}\"",
                [
                    'disbursement_id' => $disbursement->id,
                    'campaign_id' => $campaign->id,
                    'amount' => $netAmount,
                ]
            );
        }

        return redirect()->route('creator.disbursements.index')
            ->with('success', 'Withdrawal request submitted successfully. Waiting for admin approval.');
    }
}
