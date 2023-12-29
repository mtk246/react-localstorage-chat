<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Encounter.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Facility $facility
 * @property \App\Models\HealthProfessional|null $healthProfessionals
 * @property \App\Models\Patient $patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Encounter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Encounter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Encounter query()
 *
 * @mixin \Eloquent
 */
class Encounter extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'status',
        'date',
        'note',
        'patient_id',
        'facility_id',
        'health_professional_id',
    ];

    /**
     * Encounter belongs to Patient.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Encounter belongs to Facility.
     */
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    /**
     * Encounter belongs to HealthProfessional.
     */
    public function healthProfessionals(): BelongsTo
    {
        return $this->belongsTo(HealthProfessional::class);
    }
}
