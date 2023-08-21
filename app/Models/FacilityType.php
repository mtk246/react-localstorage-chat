<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\FacilityType.
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillClassification> $billClasifications
 * @property int|null $bill_clasifications_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property int|null $facilities_count
 *
 * @method static \Database\Factories\FacilityTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType query()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityType whereCode($value)
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

    protected $fillable = ['code', 'type'];

    /**
     * Company has many facilities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    public function billClasifications(): BelongsToMany
    {
        return $this->belongsToMany(BillClassification::class);
    }
}
