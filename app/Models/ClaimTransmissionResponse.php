<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimTransmissionResponse extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "claim_id",
        "claim_batch_id",
        "claim_transmission_status_id",
        "response_details"
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
