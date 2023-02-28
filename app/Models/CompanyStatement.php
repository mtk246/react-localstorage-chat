<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\CompanyStatement
 *
 * @property int $id
 * @property int|null $rule_id
 * @property int|null $when_id
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int $company_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $apply_to_ids
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\TypeCatalog|null $rule
 * @property-read \App\Models\TypeCatalog|null $when
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereApplyToIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereRuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatement whereWhenId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class CompanyStatement extends Model implements Auditable
{
    use HasFactory, AuditableTrait;
    
    protected $fillable = [
        "start_date",
        "end_date",
        "rule_id",
        "when_id",
        "apply_to_ids",
        "company_id",
        "billing_company_id"
    ];

    /**
     * CompanyStatement belongs to Rule.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rule()
    {
        return $this->belongsTo(TypeCatalog::class, 'rule_id');
    }

    /**
     * CompanyStatement belongs to When.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function when()
    {
        return $this->belongsTo(TypeCatalog::class, 'when_id');
    }

    /**
     * CompanyStatement belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * CompanyStatement belongs to Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'apply_to_ids' => 'array'
    ];

}
