<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimValidation extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "control_number",
        "claim_id",
        "insurance_policy_id",
        "response_details",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'response_details' => 'array',
    ];

    /**
     * ClaimValidation belongs to Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * ClaimValidation belongs to InsurancePolicy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insurancePolicy()
    {
        return $this->belongsTo(InsurancePolicy::class);
    }
}
