<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Encounter extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "status",
        "date",
        "note",
        "patient_id",
        "facility_id",
        "health_professional_id",
    ];

    /**
     * Encounter belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Encounter belongs to Facility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    /**
     * Encounter belongs to HealthProfessional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function healthProfessionals(): BelongsTo
    {
        return $this->belongsTo(HealthProfessional::class);
    }
}
