<?php

declare(strict_types=1);

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Payments\Refile.
 *
 * @property int $id
 * @property int $payment_service_id
 * @property string $type
 * @property int|null $policy_id
 * @property string $date
 * @property int|null $claim
 * @property string $reason
 * @property string $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\Payments\PaymentService $paymentService
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Refile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Refile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Refile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Refile whereClaim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refile whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refile whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refile wherePaymentServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refile wherePolicyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refile whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refile whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Refile extends Model
{
    use HasFactory;

    protected $table = 'payment_refiles';

    protected $fillable = [
        'payment_service_id',
        'type',
        'policy_id',
        'date',
        'claim',
        'reason',
        'note',
    ];

    public function paymentService(): BelongsTo
    {
        return $this->belongsTo(PaymentService::class);
    }
}
