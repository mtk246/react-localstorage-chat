<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimBatchStatus
 *
 * @property int $id
 * @property string $status
 * @property string $background_color
 * @property string $font_color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimBatch> $claimBatches
 * @property-read int|null $claim_batches_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereFontColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimBatchStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class ClaimBatchStatus extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'status', 'background_color', 'font_color',
    ];

    /**
     * ClaimBatchStatus has many ClaimBatches.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimBatches()
    {
        return $this->hasMany(ClaimBatch::class);
    }
}
