<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\ContractFee.
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $modifier_id
 * @property int|null $mac_locality_id
 * @property int|null $insurance_plan_id
 * @property int|null $billing_company_id
 * @property int|null $insurance_label_fee_id
 * @property int|null $contract_fee_type_id
 * @property string $start_date
 * @property string $end_date
 * @property string|null $price
 * @property string|null $price_percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\Company|null $company
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereContractFeeTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereInsuranceLabelFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereMacLocalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereModifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee wherePricePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ContractFee extends Model
{
    use HasFactory;

    /** @var string[] */
    protected $fillable = [
        'company_id',
        'modifier_id',
        'mac_locality_id',
        'insurance_plan_id',
        'billing_company_id',
        'insurance_label_fee_id',
        'contract_fee_type_id',
        'start_date',
        'end_date',
        'price',
        'price_percentage',
    ];

    /** @var string[] */
    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function procedures(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class)->withTimestamps();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function patiens(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class)
            ->using(ContractFeePatient::class)
            ->withPivot('start_date', 'end_date')
            ->withTimestamps();
    }
}
