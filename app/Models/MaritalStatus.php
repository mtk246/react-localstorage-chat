<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MaritalStatus.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaritalStatus whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class MaritalStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
