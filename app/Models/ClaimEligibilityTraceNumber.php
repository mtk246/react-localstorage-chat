<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimEligibilityTraceNumber.
 *
 * @property int $id
 * @property string $trace_type_code
 * @property string $trace_type
 * @property string $reference_identification
 * @property string $originating_company_identifier
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimEligibility $claimEligibility
 *
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
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 *
 * @mixin \Eloquent
 */
class ClaimEligibilityTraceNumber extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'claim_eligibility_id',
        'trace_type_code',
        'trace_type',
        'reference_identification',
        'originating_company_identifier',
    ];

    /**
     * ClaimEligibilityTraceNumber belongs to ClaimEligibility.
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }
}
