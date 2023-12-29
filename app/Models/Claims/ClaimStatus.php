<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\morphMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimStatus.
 *
 * @property int $id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $background_color
 * @property string|null $font_color
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimStatusClaim> $claimStatusClaims
 * @property int|null $claim_status_claims_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimSubStatus> $claimSubStatuses
 * @property int|null $claim_sub_statuses_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereFontColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ClaimStatus extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

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
