<?php

declare(strict_types=1);

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Payments\Card.
 *
 * @property \App\Models\Payments\Payment|null $payment
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Card newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Card newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Card query()
 *
 * @mixin \Eloquent
 */
final class Card extends Model
{
    use HasFactory;

    protected $table = 'payment_cards';

    /** @var string[] */
    protected $fillable = [
        'card_number',
        'expiration_date',
        'payment_id',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'expiration_date' => 'date',
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
