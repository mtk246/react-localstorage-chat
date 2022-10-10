<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimEligibilityStatus extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "claim_eligibility_id",
        "eligibility_status_id",
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status'];

    /**
     * ClaimEligibilityStatus belongs to ClaimEligibility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimEligibility()
    {
        return $this->belongsTo(ClaimEligibility::class);
    }

    /**
     * ClaimEligibilityStatus belongs to EligibilityStatus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eligibilityStatus()
    {
        return $this->belongsTo(EligibilityStatus::class);
    }

    public function getStatusAttribute()
    {
        return $this->eligibilityStatus->description ?? '';
    }
}
