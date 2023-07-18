<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\ContractFeePatient.
 *
 * @property int $id
 * @property int|null $patient_id
 * @property int|null $contract_fee_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $start_date
 * @property string|null $end_date
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereContractFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeePatient whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ContractFeePatient extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     *
     * @phpcs:disable SlevomatCodingStandard.Classes.ForbiddenPublicProperty
     */
    public $incrementing = true;

    /** @var string[] */
    protected $fillable = [
        'start_date',
        'end_date',
    ];

    /** @var string[] */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
