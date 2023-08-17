<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceTypeOfService.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceTypeOfService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceTypeOfService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceTypeOfService query()
 *
 * @mixin \Eloquent
 */
class ServiceTypeOfService extends Model
{
    use HasFactory;

    protected $fillable = ['type_of_service'];
}
