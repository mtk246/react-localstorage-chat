<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimFormP extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = "claim_forms_p";

    protected $fillable = [
        "head_benefit_plan_other",
        "date_of_current",
        "total_charge",
        "type_form_id",
        "type_insurance_id",
        "relationship_to_insured_id",
        "billing_company_id"
    ];

    protected $with = ["claimFormServices"];

    /**
     * TypeForm belongs to ClaimFormP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeForm(): BelongsTo
    {
        return $this->belongsTo(TypeForm::class);
    }

    /**
     * TypeInsurance belongs to ClaimFormP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeInsurance(): BelongsTo
    {
        return $this->belongsTo(TypeInsurance::class);
    }

    /**
     * InsurancePolicy belongs to ClaimFormP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insurancePolicy(): BelongsTo
    {
        return $this->belongsTo(InsurancePolicy::class);
    }

    /**
     * Facility belongs to ClaimFormP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    /**
     * Patient belongs to ClaimFormP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * RelationshipToInsured belongs to ClaimFormP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relationshipToInsured(): BelongsTo
    {
        return $this->belongsTo(RelationshipToInsured::class);
    }

    /**
     * BillingCompany belongs to ClaimFormP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * ClaimFormP has many ClaimFormPService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimFormServices()
    {
        return $this->hasMany(ClaimFormPService::class);
    }
}
