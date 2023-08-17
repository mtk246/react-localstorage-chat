<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RevCenter.
 *
 * @property int $id
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevCenter whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class RevCenter extends Model
{
    use HasFactory;

    protected $fillable = ['code'];
}
