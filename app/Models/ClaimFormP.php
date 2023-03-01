<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimFormP
 *
 * @property int $id
 * @property bool $head_benefit_plan_other
 * @property string|null $date_of_current
 * @property string|null $total_charge
 * @property int|null $type_form_id
 * @property int|null $type_insurance_id
 * @property int|null $relationship_to_insured_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormPService> $claimFormServices
 * @property-read int|null $claim_form_services_count
 * @property-read \App\Models\Facility $facility
 * @property-read \App\Models\InsurancePolicy $insurancePolicy
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\PatientOrInsuredInformation|null $patientOrInsuredInformation
 * @property-read \App\Models\PhysicianOrSupplierInformation|null $physicianOrSupplierInformation
 * @property-read \App\Models\RelationshipToInsured|null $relationshipToInsured
 * @property-read \App\Models\TypeForm|null $typeForm
 * @property-read \App\Models\TypeInsurance|null $typeInsurance
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereDateOfCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereHeadBenefitPlanOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereRelationshipToInsuredId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereTotalCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereTypeFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereTypeInsuranceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormP whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormPService> $claimFormServices
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormPService> $claimFormServices
 * @mixin \Eloquent
 */
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

    protected $with = ["claimFormServices", "physicianOrSupplierInformation", "patientOrInsuredInformation"];

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
     * ClaimFormP has one PhysicianOrSupplierInformation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function physicianOrSupplierInformation()
    {
        return $this->hasOne(PhysicianOrSupplierInformation::class);
    }

    /**
     * ClaimFormP has one PatientOrInsuredInformation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patientOrInsuredInformation()
    {
        return $this->hasOne(PatientOrInsuredInformation::class);
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
