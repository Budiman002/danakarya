<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $totalCampaigns = Campaign::count();
        $fundedCampaigns = Campaign::where('status', 'funded')->count();
        $totalDonations = Donation::where('status', 'confirmed')->count();
        $totalRaised = Campaign::sum('current_amount');

        $featuredCampaigns = Campaign::with(['category', 'donations'])
            ->where('status', 'active')
            ->withCount('donations')
            ->orderBy('current_amount', 'desc')
            ->limit(6)
            ->get();

        $categories = Category::withCount('campaigns')
            ->where('status', 'active')
            ->get();

        return view('public.home', compact('totalCampaigns', 'fundedCampaigns', 'totalDonations', 'totalRaised', 'featuredCampaigns', 'categories'));
    }

    public function about()
    {
        $totalCampaigns = Campaign::count();
        $fundedCampaigns = Campaign::where('status', 'funded')->count();
        $totalBackers = Donation::where('status', 'confirmed')->distinct('user_id')->count();
        $totalRaised = Campaign::sum('current_amount');

        return view('public.about', compact('totalCampaigns', 'fundedCampaigns', 'totalBackers', 'totalRaised'));
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:1000'],
        ]);
        
        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}