<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InsuranceCompanyFileMethod.
 *
 * @property int $id
 * @property string $file_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod whereFileMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyFileMethod whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class InsuranceCompanyFileMethod extends Model
{
    use HasFactory;

    protected $fillable = ['file_method'];
}
