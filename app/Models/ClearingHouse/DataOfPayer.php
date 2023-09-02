<?php

declare(strict_types=1);

namespace App\Models\ClearingHouse;

use App\Enums\Claim\ClaimType;
use App\Models\ClearingHouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ClearingHouse\DataOfPayer.
 *
 * @property int $id
 * @property string $cpid
 * @property string|null $paper_cpid
 * @property string|null $portal
 * @property ClaimType $type
 * @property string $claim_insurance_type
 * @property int|null $clearing_house_id
 * @property int $available_payer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\ClearingHouse\AvailablePayer $availablePayer
 * @property ClearingHouse|null $clearingHouse
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer query()
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer whereAvailablePayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer whereClaimInsuranceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer whereClearingHouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer whereCpid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer wherePaperCpid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer wherePortal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataOfPayer whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class DataOfPayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpid',
        'paper_cpid',
        'portal',
        'type',
        'claim_insurance_type',
        'clearing_house_id',
        'available_payer_id',
    ];

    protected $casts = [
        'type' => ClaimType::class,
    ];

    /**
     * Get the availablePayer that owns the DataOfPayer.
     */
    public function availablePayer(): BelongsTo
    {
        return $this->belongsTo(AvailablePayer::class);
    }

    /**
     * Get the clearingHouse that owns the DataOfPayer.
     */
    public function clearingHouse(): BelongsTo
    {
        return $this->belongsTo(ClearingHouse::class);
    }
}
