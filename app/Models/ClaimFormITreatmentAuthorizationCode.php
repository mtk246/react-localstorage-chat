<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimFormITreatmentAuthorizationCode extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "treatment_authorization_code",
        "claim_form_i_id"
    ];

    /**
     * ClaimFormI belongs to ClaimFormIRevenue.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimFormI(): BelongsTo
    {
        return $this->belongsTo(ClaimFormI::class);
    }
}
