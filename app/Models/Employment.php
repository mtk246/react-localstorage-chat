<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\Employment
 *
 * @property int $id
 * @property string $employer_name
 * @property string $employer_address
 * @property string $employer_phone
 * @property string $position
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|Employment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class Employment extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "employer_name",
        "employer_address",
        "employer_phone",
        "position",
        "patient_id"
    ];


    /**
     * Employment belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
