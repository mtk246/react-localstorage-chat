<?php

declare(strict_types=1);

namespace App\Models\Payments;

use Cknow\Money\Casts\MoneyDecimalCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Payments\Adjustment.
 *
 * @property int $id
 * @property int $payment_service_id
 * @property string $currency
 * @property \Cknow\Money\Money|null $amount
 * @property string $adj_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\Payments\PaymentService $paymentService
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereAdjReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment wherePaymentServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adjustment whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Adjustment extends Model
{
    use HasFactory;

    protected $table = 'payment_adjustments';

    protected $fillable = [
        'payment_service_id',
        'currency',
        'amount',
        'adj_reason',
    ];

    protected $casts = [
        'amount' => MoneyDecimalCast::class.':currency',
    ];

    public function paymentService(): BelongsTo
    {
        return $this->belongsTo(PaymentService::class);
    }
}
