<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimEligibilityStatus
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $status
 * @property string|null $background_color
 * @property string|null $font_color
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read int|null $claim_eligibilities_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereFontColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @mixin \Eloquent
 */
class ClaimEligibilityStatus extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "status", "background_color", "font_color"
    ];

    /**
     * ClaimTransmissionStatus has many ClaimTransmissionResponses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimEligibilities()
    {
        return $this->hasMany(ClaimEligibility::class);
    }
}
