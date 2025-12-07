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

    public function edit($id)
{
    $campaign = Campaign::where('user_id', Auth::id())
        ->withCount('donations')
        ->findOrFail($id);
    
    if (in_array($campaign->status, ['funded', 'rejected'])) {
        return view('creator.campaigns.edit', [
            'title' => 'Edit Campaign',
            'subtitle' => 'Cannot edit this campaign',
            'campaign' => $campaign,
            'categories' => [],
        ]);
    }
    
    $categories = Category::where('status', 'active')->get();
    
    return view('creator.campaigns.edit', [
        'title' => 'Edit Campaign',
        'subtitle' => 'Update your campaign details',
        'campaign' => $campaign,
        'categories' => $categories,
    ]);
}

public function update(Request $request, $id)
{
    $campaign = Campaign::where('user_id', Auth::id())->findOrFail($id);
    
    if (in_array($campaign->status, ['funded', 'rejected'])) {
        return redirect()->route('creator.campaigns.index')
            ->with('error', 'Cannot edit funded or rejected campaigns');
    }
    
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255', 'unique:campaigns,title,' . $id],
        'slug' => ['required', 'string', 'max:255', 'unique:campaigns,slug,' . $id],
        'category_id' => ['required', 'exists:categories,id'],
        'description' => ['required', 'string', 'min:100'],
        'target_amount' => ['required', 'numeric', 'min:100000'],
        'deadline' => ['required', 'date', 'after:today'],
        'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        
        'faq_goal' => ['nullable', 'string', 'max:500'],
        'faq_fund_usage' => ['nullable', 'string', 'max:500'],
        'faq_timeline' => ['nullable', 'string', 'max:500'],
        'faq_custom_1_question' => ['nullable', 'string', 'max:255', 'required_with:faq_custom_1_answer'],
        'faq_custom_1_answer' => ['nullable', 'string', 'max:500', 'required_with:faq_custom_1_question'],
        'faq_custom_2_question' => ['nullable', 'string', 'max:255', 'required_with:faq_custom_2_answer'],
        'faq_custom_2_answer' => ['nullable', 'string', 'max:500', 'required_with:faq_custom_2_question'],
    ]);
    
    $validated['slug'] = Str::slug($validated['slug']);
    
    $majorChanges = false;
    if ($request->title !== $campaign->title) $majorChanges = true;
    if ($request->target_amount != $campaign->target_amount) $majorChanges = true;
    if ($request->deadline !== $campaign->deadline) $majorChanges = true;
    if ($request->category_id != $campaign->category_id) $majorChanges = true;
    
    if ($majorChanges && $campaign->status === 'active') {
        $validated['status'] = 'pending';
        $message = 'Campaign updated! Major changes require admin re-approval.';
    } else {
        $message = 'Campaign updated successfully!';
    }
    
    if ($request->hasFile('image')) {
        if ($campaign->image && file_exists(public_path($campaign->image))) {
            unlink(public_path($campaign->image));
        }
        
        $file = $request->file('image');
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/campaigns'), $filename);
        $validated['image'] = 'images/campaigns/' . $filename;
    }
    
    $campaign->update($validated);
    
    return redirect()->route('creator.campaigns.index')
        ->with('success', $message);
}
}