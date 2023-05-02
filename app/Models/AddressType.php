<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AddressType.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class AddressType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
