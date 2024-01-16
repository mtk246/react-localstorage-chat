<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\TypeInsurance.
 *
 * @property int $id
 * @property string $insurance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereInsurance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeInsurance whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TypeInsurance extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'insurance',
    ];
}
