<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession; // Alias to avoid conflict if you use Laravel Session
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    public function createSession(Request $request, Campaign $campaign)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            // No validation needed for display_publicly checkbox here,
            // as its absence means false.
        ]);

        $amount = (float) $request->input('amount');
        $amountInCents = $amount * 100;
        // Convert checkbox value to boolean: '1' or on -> true, anything else/missing -> false
        $displayPublicly = filter_var($request->input('display_publicly'), FILTER_VALIDATE_BOOLEAN);


        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [[
            'price_data' => [ /* ... */],
            'quantity' => 1,
        ]];
        // Prepare line item for Stripe Checkout
        $lineItems = [[
            'price_data' => [
                'currency' => 'usd', // Or your chosen currency
                'product_data' => [
                    'name' => 'Donation: ' . $campaign->title,
                ],
                'unit_amount' => $amountInCents,
            ],
            'quantity' => 1,
        ]];


        $metadata = [
            'campaign_id' => $campaign->id,
            'campaign_title' => $campaign->title,
            'user_id' => Auth::check() ? Auth::id() : null,
            'user_email' => Auth::check() ? Auth::user()->email : null,
            'user_name' => Auth::check() ? Auth::user()->name : 'Anonymous Donor', // Get name if logged in
            'donation_amount' => $amount,
            'display_publicly' => $displayPublicly, // Add the preference
        ];

        try {
            $checkoutSession = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('donate.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('donate.cancel'),
                'metadata' => $metadata,
                'customer_email' => $request->input('checkout_email') ?: (Auth::check() ? Auth::user()->email : null), // Allow an optional email field in form, or use logged in
            ]);

            // If user is logged in and an email isn't provided via a form field for checkout
            if (Auth::check() && !$request->filled('checkout_email')) {
                $checkoutSession->customer_email = Auth::user()->email;
            }


            return redirect($checkoutSession->url);
        } catch (\Exception $e) {
            Log::error('Stripe Session Creation Failed: ' . $e->getMessage() . ' for campaign ' . $campaign->id);
            return redirect()->route('public.campaigns.show', $campaign)
                ->with('error', 'Could not initiate donation. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $stripeSessionId = $request->query('session_id');
        // ... (initial checks for session_id) ...
        if (!$stripeSessionId) {
            Log::error('Stripe success redirect missing session_id.');
            return redirect()->route('public.campaigns.index')->with('error', 'Donation session not found.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $checkoutSession = StripeSession::retrieve($stripeSessionId);

            if (Donation::where('stripe_checkout_session_id', $checkoutSession->id)->exists()) {
                // ... (existing duplicate check logic) ...
                Log::warning('Attempted to process already processed Stripe session: ' . $checkoutSession->id);
                return redirect()->route('public.campaigns.index')->with('success', 'Your donation has already been recorded. Thank you!');
            }

            if ($checkoutSession->payment_status === 'paid') {
                $metadata = $checkoutSession->metadata;
                $campaignId = $metadata->campaign_id ?? null;
                $userId = $metadata->user_id ?? null;
                $donationAmount = $checkoutSession->amount_total / 100;
                // Get display_publicly from metadata, default to false if not present
                $displayPublicly = filter_var($metadata->display_publicly ?? false, FILTER_VALIDATE_BOOLEAN);
                $donorNameForRecord = $metadata->user_name ?? ($checkoutSession->customer_details->name ?? 'Anonymous Donor');


                $campaign = Campaign::find($campaignId);
                // ... (check if campaign exists) ...
                if (!$campaign) {
                    Log::error('Campaign not found for Stripe session: ' . $checkoutSession->id . ' with campaign_id: ' . $campaignId);
                    return redirect()->route('public.campaigns.index')->with('error', 'Associated campaign not found.');
                }


                $donation = Donation::create([
                    'campaign_id' => $campaign->id,
                    'user_id' => $userId,
                    'amount' => $donationAmount,
                    'stripe_checkout_session_id' => $checkoutSession->id,
                    'status' => 'succeeded',
                    'donor_name' => ($userId || $displayPublicly) ? $donorNameForRecord : 'Anonymous Donor', // Store name if user or public, else 'Anonymous'
                    'donor_email' => $checkoutSession->customer_details->email ?? ($metadata->user_email ?? null),
                    'display_publicly' => $displayPublicly, // Save the preference
                ]);

                $campaign->increment('current_amount', $donationAmount);

                return view('public.donate.success', compact('donation', 'campaign'));
            } else {
                // ... (existing logic for non-paid status) ...
                Log::warning('Stripe session payment_status not "paid": ' . $checkoutSession->id . ' Status: ' . $checkoutSession->payment_status);
                $campaignForRedirect = Campaign::find($metadata->campaign_id ?? $campaignId); // Attempt to find campaign for redirect
                if ($campaignForRedirect) {
                    return redirect()->route('public.campaigns.show', $campaignForRedirect)->with('error', 'Payment was not successful. Please try again or contact support.');
                }
                return redirect()->route('public.campaigns.index')->with('error', 'Payment was not successful and the campaign could not be found.');
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // ... (existing error handling) ...
            Log::error('Stripe API Error on success: ' . $e->getMessage() . ' for session_id: ' . $stripeSessionId);
            return redirect()->route('public.campaigns.index')->with('error', 'Error processing your donation: ' . $e->getMessage());
        } catch (\Exception $e) {
            // ... (existing error handling) ...
            Log::error('General Error on donation success: ' . $e->getMessage() . ' for session_id: ' . $stripeSessionId);
            return redirect()->route('public.campaigns.index')->with('error', 'An unexpected error occurred. Please contact support.');
        }
    }

    public function cancel(Request $request)
    {
        // Show a cancellation message.
        return view('public.donate.cancel'); // We need to create this view
    }
}
