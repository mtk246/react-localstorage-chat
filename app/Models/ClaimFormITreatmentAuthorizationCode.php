<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimFormITreatmentAuthorizationCode.
 *
 * @property int $id
 * @property int $treatment_authorization_code
 * @property int $claim_form_i_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimFormI $claimFormI
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereClaimFormIId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereTreatmentAuthorizationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 *
 * @mixin \Eloquent
 */
class ClaimFormITreatmentAuthorizationCode extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'treatment_authorization_code',
        'claim_form_i_id',
    ];

    /**
     * ClaimFormI belongs to ClaimFormIRevenue.
     */
    public function claimFormI(): BelongsTo
    {
        return $this->belongsTo(ClaimFormI::class);
    }
}
