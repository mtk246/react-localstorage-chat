<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\morphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class ClaimStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        "status", "background_color", "font_color"
    ];

    /**
     * ClaimStatus has many ClaimStatusClaim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function claimStatusClaims(): morphMany
    {
        return $this->morphMany(ClaimStatusClaim::class, 'claim_status');
    }

    /**
     * The claimStatus that belong to the claimSubStatus.
     *
     * @return BelongsToMany
     */
    public function claimSubStatuses(): BelongsToMany
    {
        return $this->belongsToMany(ClaimSubStatus::class)->withTimestamps();
    }
}