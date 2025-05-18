<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use App\Http\Requests\Admin\StoreCampaignRequest;
use App\Http\Requests\Admin\UpdateCampaignRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{

    public function dashboard(Request $request)
    {
        $totalCampaigns = Campaign::count();
        $successfulDonationsQuery = Donation::where('status', 'succeeded');

        $totalDonationsCount = $successfulDonationsQuery->clone()->count();
        $totalAmountRaised = $successfulDonationsQuery->clone()->sum('amount');
        $averageDonationAmount = ($totalDonationsCount > 0) ? $totalAmountRaised / $totalDonationsCount : 0;

        $recentDonations = Donation::with(['campaign', 'user'])
            ->where('status', 'succeeded')
            ->latest()
            ->take(5)
            ->get();

        // Data for Donations Over Time Chart (last 30 days)
        $donationsByDay = Donation::where('status', 'succeeded')
            ->where('created_at', '>=', Carbon::now()->subDays(30)) // Get data for the last 30 days
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get([
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(amount) as total_amount')
            ])
            ->keyBy('date'); // Key by date for easy lookup

        $chartLabels = [];
        $chartData = [];

        for ($i = 10; $i >= 0; $i--) { // Iterate from 29 days ago to today
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = Carbon::parse($date)->format('M d'); // Format for display
            $chartData[] = $donationsByDay->get($date)->total_amount ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalCampaigns',
            'totalDonationsCount',
            'totalAmountRaised',
            'averageDonationAmount',
            'recentDonations',
            'chartLabels', // Use this new variable name for labels
            'chartData'    // Use this new variable name for data
        ));
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Campaign::query(); // Use query() to start building

        // Search by Title
        if ($request->filled('search_title')) {
            $query->where('title', 'like', '%' . $request->input('search_title') . '%');
        }

        // Filter by Status
        if ($request->filled('filter_status')) {
            $query->where('status', $request->input('filter_status'));
        }

        // Sorting Logic
        $sortBy = $request->input('sortBy', 'created_at'); // Default sort by creation date
        $sortDirection = $request->input('sortDirection', 'desc'); // Default sort direction

        // Validate sortBy to prevent arbitrary column sorting if necessary
        $allowedSorts = ['title', 'goal_amount', 'current_amount', 'status', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        } else {
            // Default sort if sortBy is invalid
            $query->orderBy('created_at', 'desc');
        }


        $campaigns = $query->paginate(10)->withQueryString();

        return view('admin.campaigns.index', [
            'campaigns' => $campaigns,
            'search_title' => $request->input('search_title'),
            'filter_status' => $request->input('filter_status'),
            'sortBy' => $sortBy, // Pass sort parameters to view
            'sortDirection' => $sortDirection,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampaignRequest $request)
    {
        $validatedData = $request->validated(); // Get validated data

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Store the image in 'public/campaign_images'
            // The 'public' disk is configured in config/filesystems.php
            // Make sure to run `php artisan storage:link`
            $imagePath = $request->file('image')->store('campaign_images', 'public');
        }

        Campaign::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'goal_amount' => $validatedData['goal_amount'],
            'status' => $validatedData['status'], // Or set 'active' directly if not in form
            'image_path' => $imagePath,
            'user_id' => Auth::id(), // Assign the currently logged-in admin's ID
            // current_amount defaults to 0.00 as per migration
        ]);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        return view('admin.campaigns.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $validatedData = $request->validated();

        $imagePath = $campaign->image_path; // Keep old image path by default

        if ($request->hasFile('image')) {
            // If a new image is uploaded, delete the old one first
            if ($campaign->image_path) {
                Storage::disk('public')->delete($campaign->image_path);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('campaign_images', 'public');
        }

        $campaign->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'goal_amount' => $validatedData['goal_amount'],
            'status' => $validatedData['status'],
            'image_path' => $imagePath,
            // user_id and current_amount are not typically updated here
        ]);

        return redirect()->route('admin.campaigns.show', $campaign)
            ->with('success', 'Campaign updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        // Delete the campaign image from storage if it exists
        if ($campaign->image_path) {
            Storage::disk('public')->delete($campaign->image_path);
        }

        // Delete the campaign record from the database
        $campaign->delete();

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign deleted successfully.');
    }
}
