<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimFormICodeAmount
 *
 * @property int $id
 * @property string $code
 * @property string $amount
 * @property int $claim_form_i_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormI $claimFormI
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereClaimFormIId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormICodeAmount whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ClaimFormICodeAmount extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "amount",
        "claim_form_i_id",
    ];

    /**
     * ClaimFormI belongs to ClaimFormICodeAmount.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimFormI(): BelongsTo
    {
        return $this->belongsTo(ClaimFormI::class);
    }
}
