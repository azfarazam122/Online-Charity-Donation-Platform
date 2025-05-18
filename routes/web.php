<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController; // Alias for clarity
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\CampaignUpdateController as AdminCampaignUpdateController;
use App\Http\Controllers\PublicCampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\UserDonationController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\PageController;


// Landing Page Route
Route::get('/', [PublicCampaignController::class, 'landingPage'])->name('landing');

// A dedicated route for campaign details
Route::get('/campaigns', [PublicCampaignController::class, 'index'])->name('public.campaigns.index');
Route::get('/campaigns/{campaign}', [PublicCampaignController::class, 'show'])->name('public.campaigns.show');


// Static Page Routes
Route::get('/terms-of-service', [PageController::class, 'terms'])->name('pages.terms');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('pages.privacy');

// Breeze authenticated routes (dashboard, profile)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        // We can enhance this later to show different things for donors vs admins
        if (auth()->user()->isAdmin()) {
            // Maybe redirect admin to their campaign management page by default
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.donations.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User's Donation History
    Route::get('/my-donations', [UserDonationController::class, 'index'])->name('user.donations.index');
});

// Admin specific routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Campaign Management
    Route::get('dashboard', [AdminCampaignController::class, 'dashboard'])->name('dashboard');
    Route::resource('campaigns', AdminCampaignController::class);


    // Campaign Updates Routes (nested under campaigns)
    Route::prefix('campaigns/{campaign}/updates')->name('campaigns.updates.')->group(function () {
        Route::get('/create', [AdminCampaignUpdateController::class, 'create'])->name('create');
        Route::post('/', [AdminCampaignUpdateController::class, 'store'])->name('store');
    });
    Route::get('donations', [AdminDonationController::class, 'index'])->name('donations.index');
});

// Donation Routes
Route::post('/donate/session/{campaign}', [DonationController::class, 'createSession'])->name('donate.session');
Route::get('/donate/success', [DonationController::class, 'success'])->name('donate.success');
Route::get('/donate/cancel', [DonationController::class, 'cancel'])->name('donate.cancel');


require __DIR__ . '/auth.php'; // Breeze auth routes