<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RefileReason.
 *
 * @property int $id
 * @property string $cod
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RefileReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefileReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefileReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|RefileReason whereCod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefileReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefileReason whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefileReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefileReason whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class RefileReason extends Model
{
    use HasFactory;

    protected $table = 'refile_reason';

    protected $fillable = [
        'cod',
        'description',
    ];
}
