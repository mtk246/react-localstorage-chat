<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimEligibilityTraceNumber extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "claim_eligibility_id",
        "trace_type_code",
        "trace_type",
        "reference_identification",
        "originating_company_identifier"
    ];

    /**
     * ClaimEligibilityTraceNumber belongs to ClaimEligibility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }
}
