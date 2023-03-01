<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimFormITreatmentAuthorizationCode
 *
 * @property int $id
 * @property int $treatment_authorization_code
 * @property int $claim_form_i_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormI $claimFormI
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereClaimFormIId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereTreatmentAuthorizationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
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
