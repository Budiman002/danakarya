<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalCampaigns = Campaign::where('user_id', $userId)->count();
        $activeCampaigns = Campaign::where('user_id', $userId)->where('status', 'active')->count();
        $totalRaised = Campaign::where('user_id', $userId)->sum('current_amount');
        $totalBackers = Campaign::where('user_id', $userId)->withCount('donations')->get()->sum('donations_count');

        $recentCampaigns = Campaign::where('user_id', $userId)
            ->with('category')
            ->withCount('donations')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get campaigns for analytics
        $campaigns = Campaign::where('user_id', $userId)->get();

        // Donation trends (last 7 days for dashboard preview)
        $donationTrends = Donation::whereIn('campaign_id', $campaigns->pluck('id'))
            ->where('status', 'confirmed')
            ->where('created_at', '>=', now()->subDays(7))
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(amount) as total_amount')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Fill missing dates with zero
        $trendData = [];
        $trendLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $trendLabels[] = now()->subDays($i)->format('M d');

            $found = $donationTrends->firstWhere('date', $date);
            $trendData[] = $found ? $found->total_amount : 0;
        }

        return view('creator.dashboard', [
            'title' => 'Dashboard',
            'subtitle' => 'Overview of your campaigns',
            'totalCampaigns' => $totalCampaigns,
            'activeCampaigns' => $activeCampaigns,
            'totalRaised' => $totalRaised,
            'totalBackers' => $totalBackers,
            'recentCampaigns' => $recentCampaigns,
            'trendLabels' => json_encode($trendLabels),
            'trendData' => json_encode($trendData),
        ]);
    }
}