<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\TypeDiag
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 * @property-read int|null $injuries_count
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeDiag whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 * @mixin \Eloquent
 */
class TypeDiag extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "description"
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
