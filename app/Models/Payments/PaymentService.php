<?php

declare(strict_types=1);

namespace App\Models\Payments;

use Cknow\Money\Casts\MoneyDecimalCast;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Collection;

/**
 * App\Models\Payments\PaymentService.
 *
 * @property Collection $adjustments
 * @property int|null $adjustments_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentService query()
 *
 * @mixin \Eloquent
 */
final class PaymentService extends Pivot
{
    /** @var bool */
    public $incrementing = true;

    protected $fillable = [
        'payment_id',
        'service_id',
        'claim_id',
        'currency',
        'payment',
        'exp_adj',
        'remain',
        'ins_amount',
        'resp_insurance',
        'pt_resp',
        'reason',
        'denial_reason',
        'note',
    ];

    protected $casts = [
        'payment' => MoneyDecimalCast::class.':currency',
    ];

    protected $appends = ['adjustments'];

    public function getAdjustmentsAttribute(): Collection
    {
        return $this->adjustments()->get();
    }

    public function adjustments(): HasMany
    {
        return $this->hasMany(Adjustment::class, 'payment_service_id');
    }
}
