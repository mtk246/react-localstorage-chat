<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ExceptionInsuranceCompany
 *
 * @property int $id
 * @property int $company_id
 * @property int $insurance_company_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany $billingCompany
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\InsuranceCompany $insuranceCompany
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ExceptionInsuranceCompany extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "company_id",
        "billing_company_id",
        "insurance_company_id",
    ];

    /**
     * ExceptionInsuranceCompany belongs to Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * ExceptionInsuranceCompany belongs to InsuranceCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class);
    }

    /**
     * ExceptionInsuranceCompany belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }
}
