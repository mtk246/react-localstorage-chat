<?php

declare(strict_types=1);

namespace App\Models\ClearingHouse;

use App\Enums\Claim\ClaimType;
use App\Models\ClearingHouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ClearingHouse\PayerInformation.
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
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation whereAvailablePayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation whereClaimInsuranceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation whereClearingHouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation whereCpid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation wherePaperCpid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation wherePortal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerInformation whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class PayerInformation extends Model
{
    use HasFactory;

    protected $table = 'payer_information';

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
