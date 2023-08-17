<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceApplicableTo.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApplicableTo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApplicableTo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceApplicableTo query()
 *
 * @mixin \Eloquent
 */
class ServiceApplicableTo extends Model
{
    use HasFactory;

    protected $table = 'service_applicable_to';

    protected $fillable = ['applicable_to'];
}
