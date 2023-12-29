<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\EligibilityStatus.
 *
 * @property int $id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibilityStatus> $claimEligibilityStatuses
 * @property int|null $claim_eligibility_statuses_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EligibilityStatus whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class EligibilityStatus extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'description',
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
