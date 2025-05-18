<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'goal_amount',
        'current_amount',
        'image_path',
        'status',
        'user_id',
    ];

    protected $casts = [
        'goal_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
    ];

    /**
     * Get the user (admin) that created the campaign.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the updates for the campaign.
     */
    public function updates(): HasMany
    {
        return $this->hasMany(CampaignUpdate::class)->latest();
    }

    /**
     * Get the donations for the campaign.
     */
    public function donations(): HasMany // <<< --- ADD THIS METHOD ---
    {
        return $this->hasMany(Donation::class);
    }
}
