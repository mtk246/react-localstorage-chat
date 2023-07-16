<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FacilityType.
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property int|null $facilities_count
 *
 * @method static \Database\Factories\FacilityTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType query()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class FacilityType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    /**
     * Company has many facilities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }
}
