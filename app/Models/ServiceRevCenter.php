<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceRevCenter.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceRevCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceRevCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceRevCenter query()
 *
 * @mixin \Eloquent
 */
class ServiceRevCenter extends Model
{
    use HasFactory;

    protected $fillable = ['rev_center'];
}
