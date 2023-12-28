<?php

declare(strict_types=1);

namespace App\Models\Payments;

use App\Models\Claims\Claim;
use App\Models\Claims\ClaimBatch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;

/**
 * App\Models\Payments\Eob.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $date
 * @property string $file_name
 * @property int $payment_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, Claim> $claimsMany
 * @property int|null $claims_many_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Claim> $claimsThrough
 * @property int|null $claims_through_count
 * @property \Illuminate\Support\Collection|null $claims
 * @property string|null $file_url
 * @property \App\Models\Payments\Payment $payment
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
        'payment_id',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'date' => 'date',
    ];

    /** @var string[] */
    protected $appends = ['file_url', 'claims'];

    public function getFileUrlAttribute(): ?string
    {
        return $this->file_name && !empty($this->file_name)
            ? route('payments.eobs.show', ['eob_file' => $this->file_name])
            : null;
    }

    public function getClaimsAttribute(): ?Collection
    {
        return $this->payment_id
            ? $this->claimsThrough()?->get()
            : $this->claimsMany()?->get();
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function claimsMany(): HasMany
    {
        return $this->hasMany(Claim::class);
    }

    public function claimsThrough(): HasManyThrough
    {
        return $this->hasManyThrough(Claim::class, Payment::class);
    }

    public function claimBatches(): HasManyThrough
    {
        return $this->hasManyThrough(
            ClaimBatch::class,
            Payment::class,
            'id',
            'id',
            'payment_id',
            'payment_batch_id'
        );
    }
}
