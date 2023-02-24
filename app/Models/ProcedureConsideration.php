<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ProcedureConsideration
 *
 * @property int $id
 * @property int $procedure_id
 * @property int $gender_id
 * @property int $age_init
 * @property int|null $age_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $discriminatory_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Discriminatory $discriminatory
 * @property-read \App\Models\Gender $gender
 * @property-read \App\Models\Procedure $procedure
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereAgeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereAgeInit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereDiscriminatoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ProcedureConsideration extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "procedure_id",
        "gender_id",
        "age_init",
        "age_end",
        "discriminatory_id"
    ];

    /**
     * ProcedureConsideration belongs to Modifier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }

    /**
     * ProcedureConsideration belongs to Gender.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * ProcedureConsideration belongs to Discriminatory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discriminatory()
    {
        return $this->belongsTo(Discriminatory::class);
    }
}
