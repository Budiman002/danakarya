<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
public function index(Request $request)
{
    $query = Campaign::with(['user', 'category'])
        ->withCount('donations');

    if ($request->status) {
        $query->where('status', $request->status);
    }

    if ($request->search) {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhereHas('user', function($q) use ($request) {
                  $q->where('name', 'like', '%' . $request->search . '%');
              });
        });
    }

    $campaigns = $query->orderBy('created_at', 'desc')->paginate(10);
    $categories = Category::where('status', 'active')->get();

    return view('admin.campaigns.index', [
        'title' => 'Campaign Management',
        'subtitle' => 'Manage all campaigns',
        'campaigns' => $campaigns,
        'categories' => $categories,
        'totalCampaigns' => Campaign::count(),
        'pendingCampaigns' => Campaign::where('status', 'pending')->count(),
        'activeCampaigns' => Campaign::where('status', 'active')->count(),
        'totalRaised' => Campaign::sum('current_amount'),
    ]);
}

    public function show($id)
    {
        $campaign = Campaign::with(['user', 'category', 'donations.user'])
            ->withCount('donations')
            ->findOrFail($id);

        return view('admin.campaigns.show', [
            'title' => 'Campaign Detail',
            'subtitle' => $campaign->title,
            'campaign' => $campaign,
        ]);
    }

    public function edit($id)
    {
        $campaign = Campaign::withCount('donations')->findOrFail($id);
        $categories = Category::where('status', 'active')->get();

        return view('admin.campaigns.edit', [
            'title' => 'Edit Campaign',
            'subtitle' => 'Update campaign information',
            'campaign' => $campaign,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:campaigns,slug,' . $id],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string', 'min:100'],
            'target_amount' => ['required', 'numeric', 'min:100000'],
            'deadline' => ['required', 'date', 'after:today'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'status' => ['required', 'in:pending,active,funded,rejected,cancelled'],
        ]);

        $validated['slug'] = Str::slug($validated['slug']);

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

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign updated successfully!');
    }

    public function destroy($id)
    {
        $campaign = Campaign::withCount('donations')->findOrFail($id);

        if ($campaign->donations_count > 0) {
            return back()->with('error', 
                "Cannot delete campaign '{$campaign->title}'. It has {$campaign->donations_count} donations.");
        }

        if ($campaign->image && file_exists(public_path($campaign->image))) {
            unlink(public_path($campaign->image));
        }

        $campaignTitle = $campaign->title;
        $campaign->delete();

        return redirect()->route('admin.campaigns.index')
            ->with('success', "Campaign '{$campaignTitle}' deleted successfully!");
    }

    public function approve($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        if ($campaign->status !== 'pending') {
            return back()->with('error', 'Only pending campaigns can be approved.');
        }

        $campaign->update(['status' => 'active']);

        return back()->with('success', "Campaign '{$campaign->title}' has been approved!");
    }

    public function reject($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        if ($campaign->status !== 'pending') {
            return back()->with('error', 'Only pending campaigns can be rejected.');
        }

        $campaign->update(['status' => 'rejected']);

        return back()->with('success', "Campaign '{$campaign->title}' has been rejected.");
    }
}