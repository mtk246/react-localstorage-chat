<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\PlanStatusServiceTypeCode
 *
 * @property int $id
 * @property string $service_type_code
 * @property int $claim_eligibility_plan_status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibilityPlanStatus $claimEligibilityPlanStatus
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode whereClaimEligibilityPlanStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode whereServiceTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class PlanStatusServiceTypeCode extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "service_type_code",
        "claim_eligibility_plan_status_id"
    ];

    /**
     * PlanStatusServiceTypeCode belongs to ClaimEligibilityPlanStatus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimEligibilityPlanStatus(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibilityPlanStatus::class);
    }
}
