<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\Company;
use App\Models\InsuranceCompany;
use App\Models\Patient;
use App\Models\Subscriber;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimEligibility.
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
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Claims\ClaimEligibilityStatus|null $claimEligibilityStatus
 * @property Company $company
 * @property InsuranceCompany $insuranceCompany
 * @property Patient $patient
 * @property Subscriber|null $subscriber
 *
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
 *
 * @mixin \Eloquent
 */
final class ClaimEligibility extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'control_number',
        'claim_id',
        'company_id',
        'patient_id',
        'subscriber_id',
        'insurance_policy_id',
        'insurance_company_id',
        'response_details',
        'claim_eligibility_status_id',
    ];

    protected $with = ['claimEligibilityStatus'];

    /**
     * ClaimEligibility belongs to Company.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * ClaimEligibility belongs to Patient.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * ClaimEligibility belongs to Subscriber.
     */
    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class);
    }

    /**
     * ClaimEligibility belongs to InsuranceCompany.
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
