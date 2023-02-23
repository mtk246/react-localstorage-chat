<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimEligibilityBenefitsInformationOther
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $service_type_codes
 * @property string $service_types
 * @property string $insurance_type_code
 * @property string $insurance_type
 * @property string $header_loop_identifier_code
 * @property string $trailer_loop_identifier_code
 * @property string $plan_number
 * @property string $plan_network_id_number
 * @property string $benefits_date_information
 * @property string $entity_identifier
 * @property string $entity_type
 * @property string $entity_name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $communication_mode
 * @property string $communication_number
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibility $claimEligibility
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereBenefitsDateInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereClaimEligibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereCommunicationMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereCommunicationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereEntityIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereEntityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereHeaderLoopIdentifierCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereInsuranceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereInsuranceTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther wherePlanNetworkIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther wherePlanNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereServiceTypeCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereServiceTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereTrailerLoopIdentifierCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ClaimEligibilityBenefitsInformationOther extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "claim_eligibility_id",
        "code",
        "name",
        "service_type_codes",
        "service_types",
        "insurance_type_code",
        "insurance_type",
        "header_loop_identifier_code",
        "trailer_loop_identifier_code",
        "plan_number",
        "plan_network_id_number",
        "benefits_date_information",
        "entity_identifier",
        "entity_type",
        "entity_name",
        "address",
        "city",
        "state",
        "postal_code",
        "communication_mode",
        "communication_number"
    ];

    /**
     * ClaimEligibilityBenefitsInformationOther belongs to ClaimEligibility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }
}
