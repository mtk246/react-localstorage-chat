<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ModifierInvalidCombination
 *
 * @property int $id
 * @property string $invalid_combination
 * @property int $modifier_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Modifier $modifier
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination whereInvalidCombination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination whereModifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierInvalidCombination whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ModifierInvalidCombination extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "modifier_id",
        "invalid_combination"
    ];

    /**
     * ModifierInvalidCombination belongs to Modifier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modifier()
    {
        return $this->belongsTo(Modifier::class);
    }
}
