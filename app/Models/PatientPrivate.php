<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\PatientPrivate.
 *
 * @property int $id
 * @property string $reference_num
 * @property string $patient_num
 * @property string $med_num
 * @property int $billing_company_id
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Patient $patient
 *
 * @method static \Database\Factories\PatientPrivateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereMedNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate wherePatientNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereReferenceNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPrivate whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PatientPrivate extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'reference_num',
        'patient_num',
        'med_num',
        'patient_id',
        'billing_company_id',
    ];

    /**
     * PatientPrivate belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
