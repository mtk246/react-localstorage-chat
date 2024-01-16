<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\PatientConditionRelated.
 *
 * @property int $id
 * @property bool $employment
 * @property bool $auto_accident
 * @property bool $other_accident
 * @property string|null $place_state
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Patient $patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereAutoAccident($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereEmployment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereOtherAccident($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated wherePlaceState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientConditionRelated whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PatientConditionRelated extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'patient_id',
        'employment',
        'auto_accident',
        'place_state',
        'other_accident',
    ];

    /**
     * PatientConditionRelated belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
