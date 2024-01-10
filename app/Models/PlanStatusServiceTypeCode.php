<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\PlanStatusServiceTypeCode.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimEligibilityPlanStatus|null $claimEligibilityPlanStatus
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanStatusServiceTypeCode query()
 *
 * @mixin \Eloquent
 */
class PlanStatusServiceTypeCode extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'service_type_code',
        'claim_eligibility_plan_status_id',
    ];

    /**
     * PlanStatusServiceTypeCode belongs to ClaimEligibilityPlanStatus.
     */
    public function claimEligibilityPlanStatus(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibilityPlanStatus::class);
    }
}
