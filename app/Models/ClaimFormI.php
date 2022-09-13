<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimFormI extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "claim_forms_i";

    protected $fillable = [
        "type_of_bill",
        "federal_tax_number",
        "start_date_service",
        "end_date_service",
        "admission_date",
        "admission_hour",
        "type_of_admission",
        "source_admission",
        "discharge_hour",
        "patient_discharge_stat",
        "admit_dx",
        "company_id",
        "patient_id",
        "type_form_id"
    ];

    /**
     * TypeForm belongs to ClaimFormI.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeForm(): BelongsTo
    {
        return $this->belongsTo(ClaimFormI::class);
    }

    /**
     * ClaimFormI has many ClaimFormIRevenues.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimFormIRevenues()
    {
        return $this->hasMany(ClaimFormIRevenue::class);
    }

    /**
     * ClaimFormI has many ClaimFormITreatmentAuthorizationCodes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimFormITreatmentAuthorizationCodes()
    {
        return $this->hasMany(ClaimFormITreatmentAuthorizationCode::class);
    }

    /**
     * ClaimFormI has many ClaimFormICodeAmounts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimFormICodeAmounts()
    {
        return $this->hasMany(ClaimFormICodeAmount::class);
    }

    /**
     * ClaimFormI has many ClaimFormIConditionCodes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimFormIConditionCodes()
    {
        return $this->hasMany(ClaimFormIConditionCode::class);
    }

    /**
     * ClaimFormI has many ClaimFormIOccurrences.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimFormIOccurrences()
    {
        return $this->hasMany(ClaimFormIOccurrence::class);
    }
}
