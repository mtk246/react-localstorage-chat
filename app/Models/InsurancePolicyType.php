<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InsurancePolicyType.
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicyType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class InsurancePolicyType extends Model
{
    use HasFactory;
}
