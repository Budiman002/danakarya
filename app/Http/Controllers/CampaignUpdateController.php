<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignUpdateController extends Controller
{
    public function index(Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $updates = $campaign->updates()->latest()->paginate(10);

        return view('creator.campaigns.updates.index', compact('campaign', 'updates'));
    }

    public function create(Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        return view('creator.campaigns.updates.create', compact('campaign'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('campaign-updates', 'public');
        }

        $campaign->updates()->create($validated);

        return redirect()->route('creator.campaigns.updates.index', $campaign)
            ->with('success', __('Update posted successfully!'));
    }

    public function edit(Campaign $campaign, CampaignUpdate $update)
    {
        $this->authorize('update', $campaign);

        if ($update->campaign_id !== $campaign->id) {
            abort(404);
        }

        return view('creator.campaigns.updates.edit', compact('campaign', 'update'));
    }

    public function update(Request $request, Campaign $campaign, CampaignUpdate $update)
    {
        $this->authorize('update', $campaign);

        if ($update->campaign_id !== $campaign->id) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($update->image) {
                Storage::disk('public')->delete($update->image);
            }
            $validated['image'] = $request->file('image')->store('campaign-updates', 'public');
        }

        $update->update($validated);

        return redirect()->route('creator.campaigns.updates.index', $campaign)
            ->with('success', __('Update edited successfully!'));
    }

    public function destroy(Campaign $campaign, CampaignUpdate $update)
    {
        $this->authorize('update', $campaign);

        if ($update->campaign_id !== $campaign->id) {
            abort(404);
        }

        if ($update->image) {
            Storage::disk('public')->delete($update->image);
        }

        $update->delete();

        return redirect()->route('creator.campaigns.updates.index', $campaign)
            ->with('success', __('Update deleted successfully!'));
    }
}
