<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\EnsurancePlan
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EnsurancePlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnsurancePlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnsurancePlan query()
 * @mixin \Eloquent
 */
class EnsurancePlan extends Model implements Auditable
{
    use HasFactory, AuditableTrait;
}
