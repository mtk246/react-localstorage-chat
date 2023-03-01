<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\PatientOrInsuredInformation
 *
 * @property int $id
 * @property bool $employment_related_condition
 * @property bool $auto_accident_related_condition
 * @property string|null $auto_accident_place_state
 * @property bool $other_accident_related_condition
 * @property bool $patient_signature
 * @property bool $insured_signature
 * @property int $claim_form_p_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormP $claimFormP
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereAutoAccidentPlaceState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereAutoAccidentRelatedCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereClaimFormPId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereEmploymentRelatedCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereInsuredSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereOtherAccidentRelatedCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation wherePatientSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientOrInsuredInformation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class PatientOrInsuredInformation extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = 'patient_or_insured_informations';

    protected $fillable = [
        "employment_related_condition",
        "auto_accident_related_condition",
        "auto_accident_place_state",
        "other_accident_related_condition",
        "patient_signature",
        "insured_signature",
        "claim_form_p_id"
    ];

    /**
     * PatientOrInsuredInformation belongs to ClaimFormP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimFormP()
    {
        return $this->belongsTo(ClaimFormP::class);
    }
}
