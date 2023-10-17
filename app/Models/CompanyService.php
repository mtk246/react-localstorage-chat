<?php

declare(strict_types=1);

namespace App\Models;

use Cknow\Money\Casts\MoneyStringCast;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\CompanyService.
 *
 * @property int $id
 * @property int $company_id
 * @property float|null $price
 * @property float|null $price_percentage
 * @property int|null $insurance_label_fee_id
 * @property int $billing_company_id
 * @property int|null $mac_locality_id
 * @property string|null $clia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\BillingCompany $billingCompany
 * @property \App\Models\Company $company
 * @property \App\Models\MacLocality|null $macLocality
 * @property \App\Models\Medication|null $medication
 * @property Collection<int, \App\Models\Modifier> $modifiers
 * @property int|null $modifiers_count
 * @property Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService whereClia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService whereInsuranceLabelFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService whereMacLocalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService wherePricePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyService whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class CompanyService extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'company_id',
        'billing_company_id',
        'mac_locality_id',
        'price',
        'price_percentage',
        'revenue_code_id',
        'insurance_label_fee_id',
        'clia',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'price' => MoneyStringCast::class,
    ];

    public function medication(): ?HasOne
    {
        return $this->hasOne(Medication::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    public function macLocality(): BelongsTo
    {
        return $this->belongsTo(MacLocality::class);
    }

    public function procedures(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class);
    }

    public function modifiers(): BelongsToMany
    {
        return $this->belongsToMany(Modifier::class);
    }

    public function revenueCode()
    {
        return $this->belongsTo(Procedure::class, 'revenue_code_id');
    }
}
