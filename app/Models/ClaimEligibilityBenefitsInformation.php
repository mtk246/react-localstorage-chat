<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimEligibilityBenefitsInformation.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimEligibility|null $claimEligibility
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation query()
 *
 * @mixin \Eloquent
 */
class ClaimEligibilityBenefitsInformation extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'code',
        'name',
        'service_type_codes',
        'service_types',
        'insurance_type_code',
        'insurance_type',
        'time_qualifer_code',
        'time_qualifer',
        'benefit_amount',
        'benefits_date_information',
        'additional_information',
        'claim_eligibility_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'service_type_codes' => 'array',
        'service_types' => 'array',
        'benefits_date_information' => 'array',
        'additional_information' => 'array',
    ];

    /**
     * ClaimEligibilityBenefitsInformation belongs to ClaimEligibility.
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }
}
