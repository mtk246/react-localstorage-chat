<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimEligibilityPlanStatus.
 *
 * @property int $id
 * @property string $status_code
 * @property string $status
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property int|null $claim_eligibilities_count
 * @property \App\Models\ClaimEligibility $claimEligibility
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereClaimEligibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPlanStatus whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 *
 * @mixin \Eloquent
 */
class ClaimEligibilityPlanStatus extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'status_code',
        'status',
        'claim_eligibility_id',
    ];

    /**
     * ClaimEligibilityPlanStatus belongs to ClaimEligibility.
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }

    /**
     * ClaimEligibilityPlanStatus has many claim eligibility.
     */
    public function claimEligibilities(): HasMany
    {
        return $this->hasMany(ClaimEligibility::class);
    }
}
