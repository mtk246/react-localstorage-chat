<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\BillClassification.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property int|null $facilities_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\FacilityType> $facilityTypes
 * @property int|null $facility_types_count
 *
 * @method static \Database\Factories\BillClassificationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassification query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassification whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassification whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassification whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class BillClassification extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'facility_type_id'];

    /**
     * Facility belongsToMany with BillClassification.
     */
    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }

    public function facilityTypes(): BelongsToMany
    {
        return $this->belongsToMany(FacilityType::class);
    }
}
