<?php

declare(strict_types=1);

namespace App\Models;

use Cknow\Money\Casts\MoneyStringCast;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CondoMembership.
 *
 * @property mixed $roles
 * @method static \Illuminate\Database\Eloquent\Builder|CondoMembership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CondoMembership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CondoMembership query()
 * @property int $id
 * @property int $company_id
 * @property int $procedure_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $price
 * @property float|null $price_percentage
 * @property int|null $insurance_label_fee_id
 * @property int|null $billing_company_id
 * @property int|null $modifier_id
 * @property int|null $mac_locality_id
 * @property string|null $clia
 * @property-read Collection<int, \App\Models\Medication> $medications
 * @property-read int|null $medications_count
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereClia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereInsuranceLabelFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereMacLocalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereModifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure wherePricePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyProcedure whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class CompanyProcedure extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     *
     * @phpcs:disable SlevomatCodingStandard.Classes.ForbiddenPublicProperty
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'company_id',
        'procedure_id',
        'billing_company_id',
        'mac_locality_id',
        'price',
        'price_percentage',
        'modifier_id',
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

    /** @var string[] */
    protected $appends = [
        'medications',
    ];

    /** @var string[] */
    protected $hidden = [
        'id',
    ];

    public function getMedicationsAttribute(): Collection
    {
        return $this->medications()->get();
    }

    public function medications(): ?HasMany
    {
        return $this->hasMany(Medication::class, 'company_procedure_id');
    }
}