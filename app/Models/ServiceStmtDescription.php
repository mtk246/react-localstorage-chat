<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceStmtDescription.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceStmtDescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceStmtDescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceStmtDescription query()
 *
 * @mixin \Eloquent
 */
class ServiceStmtDescription extends Model
{
    use HasFactory;

    protected $fillable = ['stmt_description'];
}
