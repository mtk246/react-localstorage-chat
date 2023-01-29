<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

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
