<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\Company;
use App\Models\Facility;
use App\Models\HealthProfessional;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Claims\ClaimDemographicInformation.
 *
 * @property \App\Models\Claims\Claim $claim
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimStatusClaim> $claimStatusClaims
 * @property int|null $claim_status_claims_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimTransmissionResponse> $claimTransmissionResponses
 * @property int|null $claim_transmission_responses_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDemographicInformation query()
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
        'validate',
        'automatic_eligibility',
        'company_id',
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

    /**
     * The healthProfessionals that belong to the Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function healthProfessionals()
    {
        return $this->belongsToMany(HealthProfessional::class, 'claim_health_professional', 'claim_id', 'health_professional_id')
            ->withPivot(['field_id', 'qualifier_id'])
            ->withTimestamps();
    }
}
