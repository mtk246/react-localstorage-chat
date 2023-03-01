<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\InsuranceCompanyTimeFailed
 *
 * @property int $id
 * @property int|null $days
 * @property int|null $from_id
 * @property int $billing_company_id
 * @property int $insurance_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany $billingCompany
 * @property-read \App\Models\TypeCatalog|null $from
 * @property-read \App\Models\InsuranceCompany $insuranceCompany
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyTimeFailed whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class InsuranceCompanyTimeFailed extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "days",
        "from_id",
        "billing_company_id",
        "insurance_company_id",
    ];

    /**
     * InsuranceCompanyTimeFailed belongs to From.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from()
    {
        return $this->belongsTo(TypeCatalog::class);
    }

    /**
     * InsuranceCompanyTimeFailed belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * InsuranceCompanyTimeFailed belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class);
    }
}
