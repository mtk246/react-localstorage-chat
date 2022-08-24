<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

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
