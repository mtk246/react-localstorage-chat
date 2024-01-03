<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimEligibilityTraceNumber.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimEligibility|null $claimEligibility
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityTraceNumber query()
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
