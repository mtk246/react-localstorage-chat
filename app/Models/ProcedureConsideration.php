<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ProcedureConsideration.
 *
 * @property int $id
 * @property int $procedure_id
 * @property int $gender_id
 * @property int $age_init
 * @property int|null $age_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $discriminatory_id
 * @property int $age_type
 * @property bool $claim_note
 * @property bool $supervisor
 * @property bool $authorization
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Discriminatory $discriminatory
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $frecuentDiagnoses
 * @property int|null $frecuent_diagnoses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Modifier> $frecuentModifiers
 * @property int|null $frecuent_modifiers_count
 * @property \App\Models\Gender $gender
 * @property \App\Models\Procedure $procedure
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereAgeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereAgeInit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereAgeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereAuthorization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereClaimNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereDiscriminatoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereSupervisor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProcedureConsideration whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ProcedureConsideration extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'procedure_id',
        'gender_id',
        'age_init',
        'age_end',
        'age_type',
        'discriminatory_id',
        'claim_note',
        'supervisor',
        'authorization',
    ];

    /** @var array<key, string> */
    protected $casts = [
        'claim_note' => 'boolean',
        'supervisor' => 'boolean',
        'authorization' => 'boolean',
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

    public function frecuentDiagnoses(): BelongsToMany
    {
        return $this->belongsToMany(Diagnosis::class);
    }

    public function frecuentModifiers(): BelongsToMany
    {
        return $this->belongsToMany(Modifier::class);
    }
}
