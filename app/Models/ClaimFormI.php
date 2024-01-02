<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimFormI.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormICodeAmount> $claimFormICodeAmounts
 * @property int|null $claim_form_i_code_amounts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIConditionCode> $claimFormIConditionCodes
 * @property int|null $claim_form_i_condition_codes_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIOccurrence> $claimFormIOccurrences
 * @property int|null $claim_form_i_occurrences_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormIRevenue> $claimFormIRevenues
 * @property int|null $claim_form_i_revenues_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimFormITreatmentAuthorizationCode> $claimFormITreatmentAuthorizationCodes
 * @property int|null $claim_form_i_treatment_authorization_codes_count
 * @property ClaimFormI|null $typeForm
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormI query()
 *
 * @mixin \Eloquent
 */
class ClaimFormI extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'claim_forms_i';

    protected $fillable = [
        'type_of_bill',
        'federal_tax_number',
        'start_date_service',
        'end_date_service',
        'admission_date',
        'admission_hour',
        'type_of_admission',
        'source_admission',
        'discharge_hour',
        'patient_discharge_stat',
        'admit_dx',
        'company_id',
        'patient_id',
        'type_form_id',
    ];

    /**
     * TypeForm belongs to ClaimFormI.
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
