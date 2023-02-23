<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\Discriminatory
 *
 * @property int $id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read int|null $modifier_considerations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureConsideration> $procedureConsiderations
 * @property-read int|null $procedure_considerations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discriminatory whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureConsideration> $procedureConsiderations
 * @mixin \Eloquent
 */
class Discriminatory extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "description"
    ];

    /**
     * Discriminatory has many ModifierConsiderations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modifierConsiderations()
    {
        return $this->hasMany(ModifierConsideration::class);
    }

    /**
     * Discriminatory has many ProcedureConsiderations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureConsiderations()
    {
        return $this->hasMany(ProcedureConsideration::class);
    }
}
