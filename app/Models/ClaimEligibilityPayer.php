<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimEligibilityPayer
 *
 * @property int $id
 * @property string $name
 * @property string $entity_type
 * @property string $entity_identifier
 * @property int $claim_eligibility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimEligibility $claimEligibility
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ClaimEligibilityPayer extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "name",
        "entity_type",
        "entity_identifier",
        "claim_eligibility_id"
    ];

    /**
     * ClaimEligibilityPayer belongs to ClaimEligibility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }
}
