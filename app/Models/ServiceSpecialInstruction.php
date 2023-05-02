<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceSpecialInstruction.
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSpecialInstruction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSpecialInstruction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceSpecialInstruction query()
 *
 * @mixin \Eloquent
 */
class ServiceSpecialInstruction extends Model
{
    use HasFactory;

    protected $fillable = ['special_instruction'];
}
