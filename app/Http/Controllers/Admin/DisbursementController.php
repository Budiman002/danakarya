<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disbursement;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisbursementController extends Controller
{
    public function index(Request $request)
    {
        $query = Disbursement::with(['campaign', 'campaign.user']);

        // Filter by status
        if ($request->status && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        } else {
            // Default to showing pending first
            $query->orderByRaw("CASE WHEN status = 'pending' THEN 1 WHEN status = 'approved' THEN 2 ELSE 3 END");
        }

        $disbursements = $query->orderBy('created_at', 'desc')->paginate(15);

        // Statistics
        $totalPending = Disbursement::where('status', 'pending')->count();
        $totalApproved = Disbursement::where('status', 'approved')->count();
        $totalRejected = Disbursement::where('status', 'rejected')->count();
        $totalAmountApproved = Disbursement::where('status', 'approved')->sum('net_amount');

        return view('admin.disbursements.index', [
            'title' => 'Withdrawal Requests',
            'subtitle' => 'Manage creator withdrawal requests',
            'disbursements' => $disbursements,
            'totalPending' => $totalPending,
            'totalApproved' => $totalApproved,
            'totalRejected' => $totalRejected,
            'totalAmountApproved' => $totalAmountApproved,
        ]);
    }

    public function show($id)
    {
        $disbursement = Disbursement::with(['campaign', 'campaign.user', 'campaign.donations'])
            ->findOrFail($id);

        // Get campaign statistics
        $campaign = $disbursement->campaign;
        $totalBackers = $campaign->donations()->where('status', 'confirmed')->distinct('user_id')->count();
        $averageDonation = $campaign->donations()->where('status', 'confirmed')->avg('amount');

        return view('admin.disbursements.show', [
            'title' => 'Withdrawal Request Detail',
            'subtitle' => 'Review withdrawal request',
            'disbursement' => $disbursement,
            'campaign' => $campaign,
            'totalBackers' => $totalBackers,
            'averageDonation' => $averageDonation,
        ]);
    }

    public function approve(Request $request, $id)
    {
        $disbursement = Disbursement::with(['campaign', 'campaign.user'])->findOrFail($id);

        // Check if already processed
        if ($disbursement->status !== 'pending') {
            return back()->with('error', 'This withdrawal request has already been processed.');
        }

        $validated = $request->validate([
            'admin_note' => 'nullable|string|max:1000',
        ]);

        // Update disbursement
        $disbursement->update([
            'status' => 'approved',
            'admin_note' => $validated['admin_note'] ?? null,
            'approved_at' => now(),
        ]);

        // Send notification to creator
        NotificationService::send(
            $disbursement->campaign->user,
            'withdrawal_approved',
            '✅ Withdrawal Request Approved',
            "Your withdrawal request for campaign \"{$disbursement->campaign->title}\" has been approved. The amount of Rp " . number_format($disbursement->net_amount, 0, ',', '.') . " will be transferred to your bank account within 3-5 business days.",
            [
                'disbursement_id' => $disbursement->id,
                'campaign_id' => $disbursement->campaign->id,
                'amount' => $disbursement->net_amount,
            ]
        );

        return redirect()->route('admin.disbursements.index')
            ->with('success', 'Withdrawal request approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $disbursement = Disbursement::with(['campaign', 'campaign.user'])->findOrFail($id);

        // Check if already processed
        if ($disbursement->status !== 'pending') {
            return back()->with('error', 'This withdrawal request has already been processed.');
        }

        $validated = $request->validate([
            'admin_note' => 'required|string|max:1000',
        ], [
            'admin_note.required' => 'Please provide a reason for rejection.',
        ]);

        // Update disbursement
        $disbursement->update([
            'status' => 'rejected',
            'admin_note' => $validated['admin_note'],
            'approved_at' => now(),
        ]);

        // Send notification to creator
        NotificationService::send(
            $disbursement->campaign->user,
            'withdrawal_rejected',
            '❌ Withdrawal Request Rejected',
            "Your withdrawal request for campaign \"{$disbursement->campaign->title}\" has been rejected. Reason: {$validated['admin_note']}",
            [
                'disbursement_id' => $disbursement->id,
                'campaign_id' => $disbursement->campaign->id,
                'reason' => $validated['admin_note'],
            ]
        );

        return redirect()->route('admin.disbursements.index')
            ->with('success', 'Withdrawal request rejected.');
    }
}
