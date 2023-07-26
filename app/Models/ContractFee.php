<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ContractFee.
 *
 * @property int $id
 * @property int|null $mac_locality_id
 * @property int|null $billing_company_id
 * @property int|null $insurance_label_fee_id
 * @property int|null $contract_fee_type_id
 * @property string $start_date
 * @property string $end_date
 * @property string|null $price
 * @property string|null $price_percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $private_note
 * @property \App\Models\Company|null $company
 * @property \App\Models\InsuranceCompany|null $insuranceCompany
 * @property \App\Models\MacLocality|null $macLocality
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Modifier> $modifiers
 * @property int|null $modifiers_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patiens
 * @property int|null $patiens_count
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
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereInsuranceLabelFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereMacLocalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee whereModifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee wherePricePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFee wherePrivateNote($value)
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
        'mac_locality_id',
        'billing_company_id',
        'insurance_label_fee_id',
        'contract_fee_type_id',
        'start_date',
        'end_date',
        'price',
        'price_percentage',
        'private_note',
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

    public function modifiers(): BelongsToMany
    {
        return $this->belongsToMany(Modifier::class)->withTimestamps();
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function insurancePlans(): BelongsToMany
    {
        return $this->belongsToMany(InsurancePlan::class)->withTimestamps();
    }

    public function ContractFeeSpecifications(): HasMany
    {
        return $this->hasMany(ContractFeeSpecification::class);
    }

    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class)
            ->using(ContractFeePatient::class)
            ->withPivot('start_date', 'end_date')
            ->withTimestamps();
    }

    public function macLocality(): BelongsTo
    {
        return $this->belongsTo(MacLocality::class);
    }
}
