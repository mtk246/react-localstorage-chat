<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimTransmissionResponse.
 *
 * @property int $id
 * @property array|null $response_details
 * @property int|null $claim_id
 * @property int|null $claim_batch_id
 * @property int|null $claim_transmission_status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Claims\Claim|null $claim
 * @property \App\Models\Claims\ClaimBatch|null $claimBatch
 * @property \App\Models\Claims\ClaimTransmissionStatus|null $claimTransmissionStatus
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereClaimBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereClaimTransmissionStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereResponseDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionResponse whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ClaimTransmissionResponse extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'claim_id',
        'claim_batch_id',
        'claim_transmission_status_id',
        'response_details',
    ];

    public function claim(): BelongsTo
    {
        return $this->belongsTo(Claim::class);
    }

    public function claimBatch(): BelongsTo
    {
        return $this->belongsTo(ClaimBatch::class);
    }

    public function claimTransmissionStatus(): BelongsTo
    {
        return $this->belongsTo(ClaimTransmissionStatus::class);
    }

    /** @var array */
    protected $casts = [
        'response_details' => 'array',
    ];
}
