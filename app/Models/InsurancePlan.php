<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\InsurancePlan
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property bool $status
 * @property string $note
 * @property string $ins_type
 * @property string $plan_type
 * @property string $cap_group
 * @property bool $accept_assign
 * @property bool $pre_authorization
 * @property bool $file_zero
 * @property bool $referral_required
 * @property bool $accrue_patient_resp
 * @property bool $require_abn
 * @property bool $pqrs_eligible
 * @property bool $allow_attached_files
 * @property string $eff_date
 * @property string $charge_using
 * @property string $format
 * @property string $method
 * @property string $naic
 * @property int $insurance_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\InsuranceCompany|null $insuranceCompany
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 * @property-read int|null $patients_count
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereAcceptAssign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereAccruePatientResp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereAllowAttachedFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereCapGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereChargeUsing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereEffDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereFileZero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereInsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereNaic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan wherePlanType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan wherePqrsEligible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan wherePreAuthorization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereReferralRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereRequireAbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InsurancePlan extends Model
{
    use HasFactory;
    protected $table = "insurance_plans";
    protected $fillable = [
        "code",
        "status",
        "ins_type",
        "name",
        "note",
        "plan_type",
        "cap_group",
        "accept_assign",
        "pre_authorization",
        "file_zero",
        "referral_required",
        "accrue_patient_resp",
        "require_abn",
        "pqrs_eligible",
        "allow_attached_files",
        "eff_date",
        "charge_using",
        "format",
        "method",
        "naic",
        "insurance_company_id"
    ];

    /**
     * @return BelongsTo
     */
    public function insuranceCompany(): BelongsTo
    {
        return $this->belongsTo(InsuranceCompany::class);
    }

    /**
     * @return BelongsToMany
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(
            Patient::class,
            "insurance_plan_patient",
            "insurance_plan_id",
            "patient_id"
        );
    }
}
