<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimFormIConditionCode.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimFormI|null $claimFormI
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIConditionCode query()
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
