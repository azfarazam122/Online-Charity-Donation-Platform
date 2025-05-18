<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignUpdate;
use Illuminate\Http\Request;

class CampaignUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Campaign $campaign)
    {
        return view('admin.campaign_updates.create', compact('campaign'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Campaign $campaign)
    {
        $validatedData = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $campaign->updates()->create([ // Using the relationship to create the update
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
        ]);

        return redirect()->route('admin.campaigns.show', $campaign)
            ->with('success', 'Campaign update posted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CampaignUpdate $campaignUpdate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CampaignUpdate $campaignUpdate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CampaignUpdate $campaignUpdate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampaignUpdate $campaignUpdate)
    {
        //
    }
}
