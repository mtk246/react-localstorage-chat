<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\TypeInsurance
 *
 * @property int $id
 * @property string $insurance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereInsurance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class TypeInsurance extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "insurance"
    ];
}
