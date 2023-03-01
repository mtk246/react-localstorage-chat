<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\PlaceOfService
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimServiceLine> $claimServiceLines
 * @property-read int|null $claim_service_lines_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property-read int|null $facilities_count
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlaceOfService whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimServiceLine> $claimServiceLines
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimServiceLine> $claimServiceLines
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @mixin \Eloquent
 */
class PlaceOfService extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "description",
    ];

    /**
     * The facilities that belong to the PlaceOfService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class)->withTimestamps();
    }

    /**
     * PlaceOfService has many ClaimServiceLine.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimServiceLines(): HasMany
    {
        return $this->hasMany(ClaimServiceLine::class);
    }
}
