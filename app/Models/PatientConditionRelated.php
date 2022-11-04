<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PatientConditionRelated extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "patient_id",
        "employment",
        "auto_accident",
        "place_state",
        "other_accident"
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
