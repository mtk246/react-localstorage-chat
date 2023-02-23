<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class InsurancePlanPrivate extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "naic",
        "format_professional_id",
        "format_institutional_id",
        "format_cms_id",
        "format_ub_id",
        "file_method_id",
        "billing_company_id",
        "insurance_plan_id"
    ];

    /**
     * InsurancePlanPrivate belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * InsurancePlanPrivate belongs to InsurancePlan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insurancePlan()
    {
        return $this->belongsTo(InsurancePlan::class);
    }

    /**
     * InsurancePlanPrivate belongs to FormatProfessional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formatProfessional()
    {
        return $this->belongsTo(TypeCatalog::class, 'format_professional_id');
    }
    
    /**
     * InsurancePlanPrivate belongs to FormatInstitutional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formatInstitutional()
    {
        return $this->belongsTo(TypeCatalog::class, 'format_institutional_id');
    }
    /**
     * InsurancePlanPrivate belongs to FormatCMS.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formatCMS()
    {
        return $this->belongsTo(TypeCatalog::class, 'format_cms_id');
    }
    /**
     * InsurancePlanPrivate belongs to FormatUB.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formatUB()
    {
        return $this->belongsTo(TypeCatalog::class, 'format_ub_id');
    }

    /**
     * InsurancePlanPrivate belongs to FileMethod.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fileMethod()
    {
        return $this->belongsTo(TypeCatalog::class, 'file_method_id');
    }
}
