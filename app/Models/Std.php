<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Std.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Std newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Std newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Std query()
 *
 * @mixin \Eloquent
 */
class Std extends Model
{
    use HasFactory;

    protected $fillable = ['std'];
}
