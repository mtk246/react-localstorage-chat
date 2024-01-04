<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimEligibilityStatus.
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $status
 * @property string|null $background_color
 * @property string|null $font_color
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimEligibility> $claimEligibilities
 * @property int|null $claim_eligibilities_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereFontColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityStatus whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ClaimEligibilityStatus extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'status', 'background_color', 'font_color',
    ];

    public function claimEligibilities(): HasMany
    {
        return $this->hasMany(ClaimEligibility::class);
    }
}
