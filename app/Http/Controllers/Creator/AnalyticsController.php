<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Get selected campaign or all campaigns
        $campaignId = $request->get('campaign_id');

        $campaignsQuery = Campaign::where('user_id', $user->id);

        if ($campaignId) {
            $campaignsQuery->where('id', $campaignId);
        }

        $campaigns = $campaignsQuery->get();
        $allUserCampaigns = Campaign::where('user_id', $user->id)->get();

        // Calculate statistics
        $totalRaised = $campaigns->sum('current_amount');
        $totalBackers = Donation::whereIn('campaign_id', $campaigns->pluck('id'))
            ->where('status', 'confirmed')
            ->distinct('user_id')
            ->count('user_id');
        $totalDonations = Donation::whereIn('campaign_id', $campaigns->pluck('id'))
            ->where('status', 'confirmed')
            ->count();
        $avgDonation = $totalDonations > 0 ? $totalRaised / $totalDonations : 0;

        // Daily/Weekly donation trends (last 30 days)
        $donationTrends = Donation::whereIn('campaign_id', $campaigns->pluck('id'))
            ->where('status', 'confirmed')
            ->where('created_at', '>=', now()->subDays(30))
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(amount) as total_amount'),
                DB::raw('COUNT(*) as total_count')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Fill missing dates with zero
        $trendData = [];
        $trendLabels = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $trendLabels[] = now()->subDays($i)->format('M d');

            $found = $donationTrends->firstWhere('date', $date);
            $trendData[] = $found ? $found->total_amount : 0;
        }

        // Top donors (highest total donations)
        $topDonors = Donation::whereIn('campaign_id', $campaigns->pluck('id'))
            ->where('status', 'confirmed')
            ->with('user')
            ->select('user_id', DB::raw('SUM(amount) as total_donated'), DB::raw('COUNT(*) as donation_count'))
            ->groupBy('user_id')
            ->orderBy('total_donated', 'desc')
            ->limit(10)
            ->get();

        // Backer growth chart (cumulative backers over time)
        $backerGrowth = Donation::whereIn('campaign_id', $campaigns->pluck('id'))
            ->where('status', 'confirmed')
            ->select(
                DB::raw('DATE(created_at) as date'),
                'user_id'
            )
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('date');

        $backerGrowthData = [];
        $backerGrowthLabels = [];
        $uniqueBackers = [];

        foreach ($backerGrowth as $date => $donations) {
            foreach ($donations as $donation) {
                if (!in_array($donation->user_id, $uniqueBackers)) {
                    $uniqueBackers[] = $donation->user_id;
                }
            }
            $backerGrowthLabels[] = \Carbon\Carbon::parse($date)->format('M d');
            $backerGrowthData[] = count($uniqueBackers);
        }

        return view('creator.analytics.index', [
            'title' => 'Campaign Analytics',
            'subtitle' => 'Visual data analytics about your campaign performance',
            'campaigns' => $allUserCampaigns,
            'selectedCampaignId' => $campaignId,
            'totalRaised' => $totalRaised,
            'totalBackers' => $totalBackers,
            'totalDonations' => $totalDonations,
            'avgDonation' => $avgDonation,
            'trendLabels' => json_encode($trendLabels),
            'trendData' => json_encode($trendData),
            'topDonors' => $topDonors,
            'backerGrowthLabels' => json_encode($backerGrowthLabels),
            'backerGrowthData' => json_encode($backerGrowthData),
        ]);
    }
}
