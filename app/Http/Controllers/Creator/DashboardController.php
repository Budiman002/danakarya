<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;

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

        return view('creator.dashboard', [
            'title' => 'Dashboard',
            'subtitle' => 'Overview of your campaigns',
            'totalCampaigns' => $totalCampaigns,
            'activeCampaigns' => $activeCampaigns,
            'totalRaised' => $totalRaised,
            'totalBackers' => $totalBackers,
            'recentCampaigns' => $recentCampaigns,
        ]);
    }
}