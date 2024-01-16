<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimFormIRevenue.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimFormI|null $claimFormI
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue query()
 *
 * @mixin \Eloquent
 */
class ClaimFormIRevenue extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'code',
        'description',
        'hcpcs',
        'service_date',
        'service_units',
        'total_charges',
        'non_covered_charges',
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
