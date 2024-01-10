<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimEligibilityPayer.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimEligibility|null $claimEligibility
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer query()
 *
 * @mixin \Eloquent
 */
class ClaimEligibilityPayer extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'name',
        'entity_type',
        'entity_identifier',
        'claim_eligibility_id',
    ];

    /**
     * ClaimEligibilityPayer belongs to ClaimEligibility.
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }
}
