<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function create()
    {
        $categories = Category::where('status', 'active')->get();

        return view('creator.campaigns.create', [
            'title' => 'Create Campaign',
            'subtitle' => 'Start your fundraising journey',
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:campaigns,title'],
            'slug' => ['required', 'string', 'max:255', 'unique:campaigns,slug'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string', 'min:100'],
            'target_amount' => ['required', 'numeric', 'min:100000'],
            'deadline' => ['required', 'date', 'after:today'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            
            'faq_goal' => ['nullable', 'string', 'max:500'],
            'faq_fund_usage' => ['nullable', 'string', 'max:500'],
            'faq_timeline' => ['nullable', 'string', 'max:500'],
            'faq_custom_1_question' => ['nullable', 'string', 'max:255', 'required_with:faq_custom_1_answer'],
            'faq_custom_1_answer' => ['nullable', 'string', 'max:500', 'required_with:faq_custom_1_question'],
            'faq_custom_2_question' => ['nullable', 'string', 'max:255', 'required_with:faq_custom_2_answer'],
            'faq_custom_2_answer' => ['nullable', 'string', 'max:500', 'required_with:faq_custom_2_question'],
        ]);

        $validated['slug'] = Str::slug($validated['slug']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/campaigns'), $filename);
            $validated['image'] = 'images/campaigns/' . $filename;
        }

        $validated['user_id'] = Auth::id();
        $validated['current_amount'] = 0;
        $validated['status'] = 'pending';

        Campaign::create($validated);

        return redirect()->route('creator.campaigns.index')
            ->with('success', 'Campaign created successfully! Waiting for admin approval.');
    }
}