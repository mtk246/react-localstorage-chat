<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\TypeDiag.
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 * @property int|null $injuries_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TypeDiag extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'code',
        'description',
    ];

    /**
     * TypeDiag has many Injuries.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function injuries()
    {
        return $this->hasMany(Injury::class);
    }
}
