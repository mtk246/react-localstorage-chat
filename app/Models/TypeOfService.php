<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TypeOfService.
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOfService whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TypeOfService extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];
}
