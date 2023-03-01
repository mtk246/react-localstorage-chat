<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimEligibilityPlanStatus
 *
 * @property int $id
 * @property string $status_code
 * @property string $status
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read int|null $claim_eligibilities_count
 * @property-read \App\Models\ClaimEligibility $claimEligibility
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereClaimEligibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @mixin \Eloquent
 */
class ClaimEligibilityPlanStatus extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "status_code",
        "status",
        "claim_eligibility_id"
    ];

    /**
     * ClaimEligibilityPlanStatus belongs to ClaimEligibility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }

    /**
     * ClaimEligibilityPlanStatus has many claim eligibility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimEligibilities(): HasMany
    {
        return $this->hasMany(ClaimEligibility::class);
    }
}
