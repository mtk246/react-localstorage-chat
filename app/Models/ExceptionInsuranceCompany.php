<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ExceptionInsuranceCompany.
 *
 * @property int $id
 * @property int $company_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $insurance_plan_ids
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany $billingCompany
 * @property \App\Models\Company $company
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereInsurancePlanIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExceptionInsuranceCompany whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ExceptionInsuranceCompany extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'company_id',
        'billing_company_id',
        'insurance_plan_ids',
    ];

    protected $casts = [
        'insurance_plan_ids' => 'array',
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
     * ExceptionInsuranceCompany belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }
}
