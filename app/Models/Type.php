<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Type
 *
 * @property int $id
 * @property string $description
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $typeCatalogs
 * @property-read int|null $type_catalogs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $typeCatalogs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $typeCatalogs
 * @mixin \Eloquent
 */
class Type extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'status'];

    /**
     * DiagnosticPointer has many claimServices.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function typeCatalogs()
    {
        return $this->hasMany(TypeCatalog::class);
    }
}

