<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Keep if used in sorting

class PublicCampaignController extends Controller
{
    /**
     * Display the landing page with featured campaigns.
     */
    public function landingPage()
    {
        $featuredCampaigns = Campaign::where('status', 'active')
            ->latest() // Get the newest active ones
            ->take(3)  // Show, for example, 3 featured campaigns
            ->get();

        return view('public.landing', compact('featuredCampaigns'));
    }

    /**
     * Display a listing of all active campaigns to the public (full list).
     */
    public function index(Request $request) // This was the old root, now for /campaigns
    {
        $query = Campaign::where('status', 'active');

        // Sorting Logic (from previous step - keep this)
        $sortBy = $request->input('sortBy', 'newest');
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'goal_high':
                $query->orderBy('goal_amount', 'desc');
                break;
            case 'goal_low':
                $query->orderBy('goal_amount', 'asc');
                break;
            case 'most_funded':
                $query->orderBy('current_amount', 'desc');
                break;
            case 'closest_to_goal':
                $query->where('goal_amount', '>', 0)
                    ->orderByRaw('(current_amount / goal_amount) DESC');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $campaigns = $query->paginate(9)->withQueryString();

        return view('public.campaigns.index', [ // This view remains for the full list
            'campaigns' => $campaigns,
            'currentSortBy' => $sortBy,
        ]);
    }

    /**
     * Display the specified campaign to the public.
     */
    public function show(Campaign $campaign)
    {
        if ($campaign->status !== 'active' && $campaign->status !== 'completed') {
            abort(404);
        }
        return view('public.campaigns.show', compact('campaign'));
    }
}
