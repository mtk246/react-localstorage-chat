<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\morphMany;

final class ClaimStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'background_color', 'font_color',
    ];

    /**
     * ClaimStatus has many ClaimStatusClaim.
     */
    public function claimStatusClaims(): morphMany
    {
        return $this->morphMany(ClaimStatusClaim::class, 'claim_status');
    }

    /**
     * The claimStatus that belong to the claimSubStatus.
     */
    public function claimSubStatuses(): BelongsToMany
    {
        return $this->belongsToMany(ClaimSubStatus::class)->withTimestamps();
    }
}
