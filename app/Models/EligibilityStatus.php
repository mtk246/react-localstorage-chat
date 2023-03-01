<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\EligibilityStatus
 *
 * @property int $id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibilityStatus> $claimEligibilityStatuses
 * @property-read int|null $claim_eligibility_statuses_count
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibilityStatus> $claimEligibilityStatuses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibilityStatus> $claimEligibilityStatuses
 * @mixin \Eloquent
 */
class EligibilityStatus extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "description"
    ];
    
    /**
     * EligibilityStatus has many ClaimEligibilityStatus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimEligibilityStatuses()
    {
        return $this->hasMany(ClaimEligibilityStatus::class);
    }
}
