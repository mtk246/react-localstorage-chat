<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InsurancePlanFormat.
 *
 * @property int $id
 * @property string $format
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanFormat whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class InsurancePlanFormat extends Model
{
    use HasFactory;

    protected $fillable = ['format'];
}
