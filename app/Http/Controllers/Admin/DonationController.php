<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation; // Import the Donation model
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of all donations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) // Inject Request
    {
        $query = Donation::with(['campaign', 'user'])->latest();

        // Search by Donor Email
        if ($request->filled('search_email')) {
            $searchTerm = $request->input('search_email');
            // Search in user's email (if user relation exists) or in donor_email field
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('user', function ($userQuery) use ($searchTerm) {
                    $userQuery->where('email', 'like', '%' . $searchTerm . '%');
                })->orWhere('donor_email', 'like', '%' . $searchTerm . '%');
            });
        }

        // Search by Campaign Title
        if ($request->filled('search_campaign')) {
            $query->whereHas('campaign', function ($campaignQuery) use ($request) {
                $campaignQuery->where('title', 'like', '%' . $request->input('search_campaign') . '%');
            });
        }

        // Search by Stripe Session ID
        if ($request->filled('search_stripe_id')) {
            $query->where('stripe_checkout_session_id', 'like', '%' . $request->input('search_stripe_id') . '%');
        }

        $donations = $query->paginate(15)->withQueryString(); // withQueryString appends search params to pagination links

        return view('admin.donations.index', [
            'donations' => $donations,
            'search_email' => $request->input('search_email'), // Pass search terms back to view
            'search_campaign' => $request->input('search_campaign'),
            'search_stripe_id' => $request->input('search_stripe_id'),
        ]);
    }
    // We can add a show method later if needed to view individual donation details
    // public function show(Donation $donation)
    // {
    //     return view('admin.donations.show', compact('donation'));
    // }
}
