<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimEligibility
 *
 * @property int $id
 * @property string $control_number
 * @property int $patient_id
 * @property int $company_id
 * @property int|null $subscriber_id
 * @property int $insurance_policy_id
 * @property int $insurance_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $response_details
 * @property int|null $claim_id
 * @property int|null $claim_eligibility_status_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibilityStatus|null $claimEligibilityStatus
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\InsuranceCompany $insuranceCompany
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Subscriber|null $subscriber
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereClaimEligibilityStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereControlNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereInsurancePolicyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereResponseDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereSubscriberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibility whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ClaimEligibility extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "control_number",
        "claim_id",
        "company_id",
        "patient_id",
        "subscriber_id",
        "insurance_policy_id",
        "insurance_company_id",
        "response_details",
        "claim_eligibility_status_id",
    ];

    protected $with = ['claimEligibilityStatus'];

    /**
     * ClaimEligibility belongs to Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * ClaimEligibility belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * ClaimEligibility belongs to Subscriber.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class);
    }

    /**
     * ClaimEligibility belongs to InsuranceCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceCompany(): BelongsTo
    {
        return $this->belongsTo(InsuranceCompany::class);
    }

    /**
     * ClaimEligibility belongs to ClaimEligibilityStatus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function claimEligibilityStatus()
    {
        return $this->belongsTo(ClaimEligibilityStatus::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'response_details' => 'array',
    ];
}
