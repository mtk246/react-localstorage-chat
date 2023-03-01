<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimFormI
 *
 * @property int $id
 * @property string $type_of_bill
 * @property string $federal_tax_number
 * @property string|null $start_date_service
 * @property string|null $end_date_service
 * @property string|null $admission_date
 * @property int|null $admission_hour
 * @property string $type_of_admission
 * @property string $source_admission
 * @property int|null $discharge_hour
 * @property int|null $patient_discharge_stat
 * @property int|null $admit_dx
 * @property int $type_form_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIConditionCode> $claimFormIConditionCodes
 * @property-read int|null $claim_form_i_condition_codes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIOccurrence> $claimFormIOccurrences
 * @property-read int|null $claim_form_i_occurrences_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIRevenue> $claimFormIRevenues
 * @property-read int|null $claim_form_i_revenues_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormITreatmentAuthorizationCode> $claimFormITreatmentAuthorizationCodes
 * @property-read int|null $claim_form_i_treatment_authorization_codes_count
 * @property-read ClaimFormI $typeForm
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereAdmissionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereAdmissionHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereAdmitDx($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereDischargeHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereEndDateService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereFederalTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI wherePatientDischargeStat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereSourceAdmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereStartDateService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereTypeFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereTypeOfAdmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereTypeOfBill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormICodeAmount> $claimFormICodeAmounts
 * @property-read int|null $claim_form_i_code_amounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIConditionCode> $claimFormIConditionCodes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIOccurrence> $claimFormIOccurrences
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIRevenue> $claimFormIRevenues
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormITreatmentAuthorizationCode> $claimFormITreatmentAuthorizationCodes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormICodeAmount> $claimFormICodeAmounts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIConditionCode> $claimFormIConditionCodes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIOccurrence> $claimFormIOccurrences
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIRevenue> $claimFormIRevenues
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormITreatmentAuthorizationCode> $claimFormITreatmentAuthorizationCodes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormICodeAmount> $claimFormICodeAmounts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIConditionCode> $claimFormIConditionCodes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIOccurrence> $claimFormIOccurrences
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIRevenue> $claimFormIRevenues
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormITreatmentAuthorizationCode> $claimFormITreatmentAuthorizationCodes
 * @mixin \Eloquent
 */
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
