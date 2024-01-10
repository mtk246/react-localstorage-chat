<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimFormITreatmentAuthorizationCode.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimFormI|null $claimFormI
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormITreatmentAuthorizationCode query()
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
