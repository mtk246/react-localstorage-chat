<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimFormIConditionCode.
 *
 * @property int $id
 * @property string $code
 * @property int $claim_form_i_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimFormI $claimFormI
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode whereClaimFormIId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 *
 * @mixin \Eloquent
 */
class ClaimFormIConditionCode extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'code',
        'claim_form_i_id',
    ];

    /**
     * ClaimFormI belongs to ClaimFormICodeAmount.
     */
    public function claimFormI(): BelongsTo
    {
        return $this->belongsTo(ClaimFormI::class);
    }
}
