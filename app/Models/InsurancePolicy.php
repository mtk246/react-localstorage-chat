<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\InsurancePolicy
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read int|null $claim_eligibilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimValidation> $claimValidations
 * @property-read int|null $claim_validations_count
 * @property-read mixed $insurance_company_id
 * @property-read mixed $insurance_company_name
 * @property-read mixed $own
 * @property-read mixed $payer_id
 * @property-read mixed $subscriber
 * @property-read \App\Models\InsurancePlan $insurancePlan
 * @property-read \App\Models\TypeCatalog|null $insurancePolicyType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property-read int|null $patients_count
 * @property-read \App\Models\PayerResponsibility|null $payerResponsibility
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @property-read int|null $subscribers_count
 * @property-read \App\Models\TypeCatalog|null $typeResponsibility
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereAssignBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereEffDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereGroupNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereInsurancePolicyTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePayerResponsibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePaymentResponsibilityLevelCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy wherePolicyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereReleaseInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereTypeResponsibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimValidation> $claimValidations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimValidation> $claimValidations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @mixin \Eloquent
 */
class InsurancePolicy extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "eff_date",
        "end_date",
        "release_info",
        "assign_benefits",
        "policy_number",
        "group_number",
        "insurance_plan_id",
        "insurance_policy_type_id",
        "type_responsibility_id",
        "payer_responsibility_id",
        "payment_responsibility_level_code",
    ];

    protected $with = ['insurancePlan'];
    
    protected $appends = ['insurance_company_name', 'insurance_company_id', 'subscriber', 'payer_id', 'own'];

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
     * The patients that belong to the insurancePolicy.
     *
     * @return BelongsToMany
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class)->withPivot('own_insurance')->withTimestamps();
    }

    /**
     * The subscribers that belong to the insurancePolicy.
     *
     * @return BelongsToMany
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

    public function getOwnAttribute()
    {
        return $this->pivot['own_insurance'] ?? null;
    }

    public function getSubscriberAttribute()
    {
	    if (isset($this->pivot['own_insurance'])) {
	        return (!$this->pivot['own_insurance']) ? ($this->subscribers['0']->load(['addresses', 'contacts']) ?? null) : null;
	    }
    }
}
