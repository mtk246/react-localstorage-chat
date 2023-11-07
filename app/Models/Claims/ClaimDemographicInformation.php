<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Enums\Claim\SplitCompanyClaimType;
use App\Models\Company;
use App\Models\Facility;
use App\Models\HealthProfessional;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Claims\ClaimDemographicInformation.
 *
 * @property int $id
 * @property int $claim_id
 * @property int|null $company_id
 * @property int|null $facility_id
 * @property int|null $patient_id
 * @property string|null $type_of_medical_assistance
 * @property string|null $prior_authorization_number
 * @property string $charges
 * @property string|null $auto_accident_place_state
 * @property bool $accept_assignment
 * @property bool $patient_signature
 * @property bool $insured_signature
 * @property bool $outside_lab
 * @property bool $employment_related_condition
 * @property bool $auto_accident_related_condition
 * @property bool $other_accident_related_condition
 * @property bool $validate
 * @property bool $automatic_eligibility
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $bill_classification
 * @property SplitCompanyClaimType|null $split_company_type
 * @property \App\Models\Claims\Claim $claim
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimStatusClaim> $claimStatusClaims
 * @property int|null $claim_status_claims_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimTransmissionResponse> $claimTransmissionResponses
 * @property int|null $claim_transmission_responses_count
 * @property Company|null $company
 * @property Facility|null $facility
 * @property \Illuminate\Database\Eloquent\Collection<int, HealthProfessional> $healthProfessionals
 * @property int|null $health_professionals_count
 * @property Patient|null $patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereAcceptAssignment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereAutoAccidentPlaceState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereAutoAccidentRelatedCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereAutomaticEligibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereBillClassification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereEmploymentRelatedCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereInsuredSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereOtherAccidentRelatedCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereOutsideLab($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation wherePatientSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation wherePriorAuthorizationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereSplitCompanyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereTypeOfMedicalAssistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation whereValidate($value)
 *
 * @mixin \Eloquent
 */
final class ClaimDemographicInformation extends Model
{
    use HasFactory;

    protected $table = 'claim_demographic';

    protected $fillable = [
        'claim_id',
        'type_of_medical_assistance',
        'bill_classification',
        'validate',
        'automatic_eligibility',
        'company_id',
        'split_company_type',
        'facility_id',
        'patient_id',
        'prior_authorization_number',
        'accept_assignment',
        'patient_signature',
        'insured_signature',
        'outside_lab',
        'charges',
        'employment_related_condition',
        'auto_accident_related_condition',
        'auto_accident_place_state',
        'other_accident_related_condition',
    ];

    protected $casts = [
        'split_company_type' => SplitCompanyClaimType::class,
    ];

    /**
     * Claim belongs to Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * Claim belongs to Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Claim belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Claim belongs to Facility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    /**
     * The insurance policies that belong to the Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function claimStatusClaims()
    {
        return $this->hasMany(ClaimStatusClaim::class);
    }

    /**
     * Claim has many ClaimTransmissionResponses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimTransmissionResponses()
    {
        return $this->hasMany(ClaimTransmissionResponse::class);
    }

    public function getTypeOfMedicalAssistance(): int
    {
        return 'inpatient' == $this->type_of_medical_assistance ? 1 : 3;
    }

    /**
     * The healthProfessionals that belong to the Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function healthProfessionals()
    {
        return $this->belongsToMany(HealthProfessional::class, 'claim_health_professional', 'claim_id', 'health_professional_id', 'claim_id')
            ->withPivot(['field_id', 'qualifier_id'])
            ->withTimestamps();
    }
}
