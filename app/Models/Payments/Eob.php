<?php

declare(strict_types=1);

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * App\Models\Payments\Eob.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon $date
 * @property string $file_name
 * @property int $payment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\Payments\Batch|null $batch
 * @property string|null $file_url
 * @property \App\Models\Payments\Payment|null $payments
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Eob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Eob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Eob query()
 * @method static \Illuminate\Database\Eloquent\Builder|Eob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eob whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eob whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eob whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eob wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eob whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Eob extends Model
{
    use HasFactory;

    protected $table = 'payment_eobs';

    /** @var string[] */
    protected $fillable = [
        'name',
        'date',
        'file_name',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'date' => 'date',
    ];

    /** @var string[] */
    protected $appends = ['file_url'];

    public function getFileUrlAttribute(): ?string
    {
        return $this->file_name && !empty($this->file_name)
            ? route('payments.eob.show', ['eob_file' => $this->file_name])
            : null;
    }

    public function payments(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function batch(): HasOneThrough
    {
        return $this->hasOneThrough(Batch::class, Payment::class);
    }
}
