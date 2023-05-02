<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimEligibilityPayer.
 *
 * @property int $id
 * @property string $name
 * @property string $entity_type
 * @property string $entity_identifier
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimEligibility $claimEligibility
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereClaimEligibilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereEntityIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityPayer whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
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
