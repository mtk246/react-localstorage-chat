<?php

declare(strict_types=1);

namespace App\Models\Payments;

use App\Models\Claims\Claim;
use App\Models\Claims\Services;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\Payments\ClaimPayment.
 *
 * @property int $id
 * @property int $claim_id
 * @property int $payment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property Claim $claim
 * @property \App\Models\Payments\Payment $payment
 * @property \Illuminate\Database\Eloquent\Collection<int, Services> $services
 * @property int|null $services_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimPayment whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimPayment wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimPayment whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ClaimPayment extends Pivot
{
    /** @var bool */
    public $incrementing = true;

    protected $table = 'claim_payment';

    protected $fillable = [
        'claim_id',
        'payment_id',
    ];

    public function claim(): BelongsTo
    {
        return $this->belongsTo(Claim::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Services::class, 'payment_services', 'payment_id', 'service_id')
            ->using(PaymentService::class)
            ->withPivot([
                'id',
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
            ])
            ->withTimestamps();
    }
}
