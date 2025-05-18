<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'user_id',
        'amount',
        'stripe_checkout_session_id',
        'status',
        'donor_name',
        'donor_email',
        'display_publicly', // Added
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'display_publicly' => 'boolean', // Added cast
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
