<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimEligibilityBenefitsInformation
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property array|null $service_type_codes
 * @property array|null $service_types
 * @property string|null $insurance_type_code
 * @property string|null $insurance_type
 * @property string|null $time_qualifer_code
 * @property string|null $time_qualifer
 * @property string|null $benefit_amount
 * @property array|null $benefits_date_information
 * @property array|null $additional_information
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibility $claimEligibility
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereAdditionalInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereBenefitAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereBenefitsDateInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereClaimEligibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereInsuranceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereInsuranceTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereServiceTypeCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereServiceTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereTimeQualifer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereTimeQualiferCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ClaimEligibilityBenefitsInformation extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "service_type_codes",
        "service_types",
        "insurance_type_code",
        "insurance_type",
        "time_qualifer_code",
        "time_qualifer",
        "benefit_amount",
        "benefits_date_information",
        "additional_information",
        "claim_eligibility_id",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'service_type_codes'        => 'array',
        "service_types"             => 'array',
        "benefits_date_information" => 'array',
        "additional_information"    => 'array'
    ];

    /**
     * ClaimEligibilityBenefitsInformation belongs to ClaimEligibility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }
}
