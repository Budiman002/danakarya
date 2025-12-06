<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $query = Campaign::where('user_id', Auth::id())
            ->with('category')
            ->withCount('donations');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $campaigns = $query->orderBy('created_at', 'desc')->paginate(9);

        return view('creator.campaigns.index', [
            'title' => 'My Campaigns',
            'subtitle' => 'Manage your campaigns',
            'campaigns' => $campaigns,
        ]);
    }
}