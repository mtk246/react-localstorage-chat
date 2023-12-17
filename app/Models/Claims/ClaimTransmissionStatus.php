<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimTransmissionStatus.
 *
 * @property int $id
 * @property string $status
 * @property string $background_color
 * @property string $font_color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimTransmissionResponse> $ClaimTransmissionResponses
 * @property int|null $claim_transmission_responses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereFontColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimTransmissionStatus whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ClaimTransmissionStatus extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'status', 'background_color', 'font_color',
    ];

    public function ClaimTransmissionResponses(): HasMany
    {
        return $this->hasMany(ClaimTransmissionResponse::class);
    }
}
