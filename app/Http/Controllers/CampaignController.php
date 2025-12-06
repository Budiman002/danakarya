<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $query = Campaign::with(['category', 'user'])
            ->where('status', 'active')
            ->withCount('donations');

        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'popular':
                $query->orderBy('current_amount', 'desc');
                break;
            case 'ending':
                $query->orderBy('deadline', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $campaigns = $query->paginate(9)->withQueryString();
        $categories = Category::where('status', 'active')->withCount('campaigns')->get();

        return view('campaigns.index', compact('campaigns', 'categories'));
    }

    public function show($slug)
    {
        $campaign = Campaign::with(['category', 'user', 'donations'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('campaigns.show', compact('campaign'));
    }
}