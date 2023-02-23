<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TypeForm
 *
 * @property int $id
 * @property string $form
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm whereForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeForm whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TypeForm extends Model
{
    use HasFactory;

    protected $fillable = ['form'];
}
