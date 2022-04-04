<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
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
class InsurancePlan extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "ins_type",
        "cap_group",
        "accept_assign",
        "pre_authorization",
        "file_zero_changes",
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
     * InsurancePlan belongs to InsuranceCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceCompany(): BelongsTo
    {
        return $this->belongsTo(InsuranceCompany::class);
    }

    /**
     * InsurancePlan belongs to Patients.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class)->withPivot('status', 'own_insurance')->withTimestamps();
    }

    /**
     * InsurancePlan belongs to Services.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withPivot('price', 'aliance')->withTimestamps();
    }

    /**
     * InsurancePlan belongs to Suscribers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function suscribers(): BelongsToMany
    {
        return $this->belongsToMany(Suscriber::class)->withTimestamps();
    }

    /**
     * The billingCompanies that belong to the insurancePlan.
     *
     * @return BelongsToMany
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * InsurancePlan morphs many PublicNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function publicNotes()
    {
        return $this->morphMany(PublicNote::class, 'publishable');
    }

    /**
     * InsurancePlan morphs many privateNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function privateNotes()
    {
        return $this->morphMany(PrivateNote::class, 'publishable');
    }

    /**
     * InsurancePlan morphs many EntityNicknames.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function nicknames()
    {
        return $this->morphMany(EntityNickname::class, 'nicknamable');
    }
}
