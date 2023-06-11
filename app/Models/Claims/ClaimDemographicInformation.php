<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ClaimDemographicInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_id',
        'type_of_medical_assistance',
        'format',
        'validate',
        'automatic_eligibility',
        'billing_company_id',
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
     * Claim belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
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
        return $this->belongsToMany(HealthProfessional::class, 'claim_health_professional', 'claim_id', 'health_professional_id')->withPivot(['field_id', 'qualifier_id'])->withTimestamps();
    }
}
