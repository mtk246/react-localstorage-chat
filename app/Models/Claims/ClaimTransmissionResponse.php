<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

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

    /**
     * ClaimTransmissionResponse belongs to Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * ClaimTransmissionResponse belongs to ClaimTransmissionResponse.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimTransmissionStatus()
    {
        return $this->belongsTo(ClaimTransmissionStatus::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'response_details' => 'array',
    ];
}
