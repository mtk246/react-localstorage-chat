<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClaimTransmissionStatus.
 *
 * @property int $id
 * @property string $status
 * @property string $background_color
 * @property string $font_color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $ClaimTransmissionResponses
 * @property int|null $claim_transmission_responses_count
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
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $ClaimTransmissionResponses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $ClaimTransmissionResponses
 *
 * @mixin \Eloquent
 */
class ClaimTransmissionStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'background_color', 'font_color',
    ];

    /**
     * ClaimTransmissionStatus has many ClaimTransmissionResponses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ClaimTransmissionResponses()
    {
        return $this->hasMany(ClaimTransmissionResponse::class);
    }
}
