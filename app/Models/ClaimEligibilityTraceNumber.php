<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimEligibilityTraceNumber
 *
 * @property int $id
 * @property string $trace_type_code
 * @property string $trace_type
 * @property string $reference_identification
 * @property string $originating_company_identifier
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibility $claimEligibility
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereClaimEligibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereOriginatingCompanyIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereReferenceIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereTraceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereTraceTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
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
