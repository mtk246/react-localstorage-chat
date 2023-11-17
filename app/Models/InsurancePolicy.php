<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InsurancePolicy.
 *
 * @property int $id
 * @property string $policy_number
 * @property string|null $group_number
 * @property string|null $payment_responsibility_level_code
 * @property string|null $eff_date
 * @property string|null $end_date
 * @property bool $release_info
 * @property bool $assign_benefits
 * @property int $insurance_plan_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $payer_responsibility_id
 * @property int|null $insurance_policy_type_id
 * @property int|null $type_responsibility_id
 * @property int|null $billing_company_id
 * @property int|null $patient_id
 * @property bool $status
 * @property bool $own
 * @property int|null $plan_type_id
 * @property bool $dual_plan
 * @property int|null $complementary_policy_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property int|null $claim_eligibilities_count
 * @property \App\Models\ClaimEligibility|null $claimLastEligibility
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimValidation> $claimValidations
 * @property int|null $claim_validations_count
 * @property mixed $insurance_company_id
 * @property mixed $insurance_company_name
 * @property mixed $payer_id
 * @property mixed $subscriber
 * @property \App\Models\InsurancePlan $insurancePlan
 * @property \App\Models\TypeCatalog|null $insurancePolicyType
 * @property \App\Models\Patient|null $patient
 * @property \App\Models\PayerResponsibility|null $payerResponsibility
 * @property \App\Models\TypeCatalog|null $planType
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @property int|null $subscribers_count
 * @property \App\Models\TypeCatalog|null $typeResponsibility
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereAssignBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereComplementaryPolicyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereDualPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereEffDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereGroupNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereInsurancePolicyTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereOwn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePayerResponsibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePaymentResponsibilityLevelCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePlanTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePolicyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereReleaseInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereTypeResponsibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class InsurancePolicy extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'own',
        'status',
        'eff_date',
        'end_date',
        'release_info',
        'assign_benefits',
        'policy_number',
        'group_number',
        'plan_type_id',
        'insurance_plan_id',
        'insurance_policy_type_id',
        'type_responsibility_id',
        'payer_responsibility_id',
        'payment_responsibility_level_code',
        'patient_id',
        'billing_company_id',
        'complementary_policy_id',
        'dual_plan',
    ];

    protected $with = ['insurancePlan'];

    protected $appends = ['insurance_company_name', 'insurance_company_id', 'subscriber', 'payer_id'];

    /**
     * Get the patient that owns the InsurancePolicy.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the billingCompany that owns the InsurancePolicy.
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * InsurancePolicy has many ClaimEligibilities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimEligibilities()
    {
        return $this->hasMany(ClaimEligibility::class);
    }

    public function claimLastEligibility()
    {
        return $this->hasOne(ClaimEligibility::class)->latestOfMany();
    }

    /**
     * InsurancePolicy has many ClaimValidations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimValidations()
    {
        return $this->hasMany(ClaimValidation::class);
    }

    /**
     * The subscribers that belong to the insurancePolicy.
     */
    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class)->withTimestamps();
    }

    /**
     * InsurancePolicy belongs to InsurancePlan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insurancePlan()
    {
        return $this->belongsTo(InsurancePlan::class);
    }

    /**
     * InsurancePolicy belongs to PlanType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function planType()
    {
        return $this->belongsTo(TypeCatalog::class, 'plan_type_id');
    }

    /**
     * InsurancePolicy belongs to TypeResponsibility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeResponsibility()
    {
        return $this->belongsTo(TypeCatalog::class, 'type_responsibility_id');
    }

    /**
     * InsurancePolicy belongs to InsurancePolicyType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insurancePolicyType()
    {
        return $this->belongsTo(TypeCatalog::class, 'insurance_policy_type_id');
    }

    /**
     * InsurancePolicy belongs to PayerResponsibility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payerResponsibility()
    {
        return $this->belongsTo(PayerResponsibility::class);
    }

    /**
     * InsurancePolicy belongs to ComplementaryPolicy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complementaryPolicy()
    {
        return $this->belongsTo(InsurancePolicy::class, 'complementary_policy_id');
    }

    public function getInsuranceCompanyNameAttribute()
    {
        return $this->insurancePlan['insuranceCompany']['name'];
    }

    public function getInsuranceCompanyIdAttribute()
    {
        return $this->insurancePlan['insurance_company_id'];
    }

    public function getPayerIdAttribute()
    {
        return $this->insurancePlan['insuranceCompany']['payer_id'];
    }

    public function getSubscriberAttribute()
    {
        if (isset($this->own)) {
            return (!$this->own)
                ? ((count($this->subscribers) > 1)
                    ? $this->subscribers['0']->load(['addresses', 'contacts']) ?? null
                    : null)
                : null;
        }
    }
}
