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
        "file_capitated",
        "format_id",
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
     * InsurancePlanPrivate belongs to Format.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function format()
    {
        return $this->belongsTo(TypeCatalog::class, 'format_id');
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
