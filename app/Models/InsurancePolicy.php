<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

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
        return $this->insurancePlan['insuranceCompany']['code'];
    }

    public function getOwnAttribute()
    {
        return $this->pivot['own_insurance'];
    }

    public function getSubscriberAttribute()
    {
	if(isset($this->pivot['own_insurance'])) {
	    return (!$this->pivot['own_insurance']) ? ($this->subscribers['0']->load(['addresses', 'contacts']) ?? null) : null;
	}
    }
}
