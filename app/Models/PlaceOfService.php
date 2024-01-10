<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\PlaceOfService.
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimServiceLine> $claimServiceLines
 * @property int|null $claim_service_lines_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property int|null $facilities_count
 *
 * @method static \Database\Factories\PlaceOfServiceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PlaceOfService extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    /**
     * The facilities that belong to the PlaceOfService.
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class)->withTimestamps();
    }

    /**
     * PlaceOfService has many ClaimServiceLine.
     */
    public function claimServiceLines(): HasMany
    {
        return $this->hasMany(ClaimServiceLine::class);
    }
}
