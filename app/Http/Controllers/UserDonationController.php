<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // To get the authenticated user
use App\Models\Donation; // Import the Donation model

class UserDonationController extends Controller
{
    /**
     * Display a listing of the authenticated user's donations.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $donations = Donation::where('user_id', $user->id)
            ->with('campaign') // Eager load campaign details
            ->latest() // Show newest donations first
            ->paginate(10); // Or your preferred number

        return view('user.donations.index', compact('donations'));
    }
}
