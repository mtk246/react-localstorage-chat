<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\morphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClaimStatus
 *
 * @property int $id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $background_color
 * @property string|null $font_color
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property-read int|null $claim_status_claims_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimSubStatus> $claimSubStatuses
 * @property-read int|null $claim_sub_statuses_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereFontColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimSubStatus> $claimSubStatuses
 * @mixin \Eloquent
 */
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