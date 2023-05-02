<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TypeCatalog.
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property bool $status
 * @property int $type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\Type $type
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeCatalog whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TypeCatalog extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'description', 'status', 'type_id'];

    /**
     * TypeCatalog belongs to Type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
