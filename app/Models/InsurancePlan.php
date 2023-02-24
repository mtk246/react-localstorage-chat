<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
 * @property bool $file_zero_changes
 * @property int|null $charge_using_id
 * @property int|null $ins_type_id
 * @property int|null $plan_type_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read int|null $abbreviations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read int|null $billing_companies_count
 * @property-read \App\Models\TypeCatalog|null $chargeUsing
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 * @property-read mixed $last_modified
 * @property-read \App\Models\TypeCatalog|null $insType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanPrivate> $insurancePlanPrivate
 * @property-read int|null $insurance_plan_private_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property-read int|null $insurance_plan_services_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read int|null $insurance_policies_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read int|null $nicknames_count
 * @property-read \App\Models\TypeCatalog|null $planType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read int|null $private_notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read int|null $procedures_count
 * @property-read \App\Models\PublicNote|null $publicNote
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityTimeFailed> $timeFaileds
 * @property-read int|null $time_faileds_count
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereChargeUsingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereFileZeroChanges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereInsTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan wherePlanTypeId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanPrivate> $insurancePlanPrivate
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityTimeFailed> $timeFaileds
 * @mixin \Eloquent
 */
class InsurancePlan extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "accept_assign",
        "pre_authorization",
        "file_zero_changes",
        "referral_required",
        "accrue_patient_resp",
        "require_abn",
        "pqrs_eligible",
        "allow_attached_files",
        "eff_date",
        "ins_type_id",
        "plan_type_id",
        "charge_using_id",
        "insurance_company_id"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

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
     * InsurancePlan belongs to InsType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insType()
    {
        return $this->belongsTo(TypeCatalog::class, 'ins_type_id');
    }

    /**
     * InsurancePlan belongs to PlanType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function planType()
    {
        return $this->belongsTo(TypeCatalog::class, 'plan_type_id');
    }

    /**
     * InsurancePlan belongs to ChargeUsing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chargeUsing()
    {
        return $this->belongsTo(TypeCatalog::class, 'charge_using_id');
    }

    /**
     * InsurancePlan has many InsurancePlanPrivate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function insurancePlanPrivate()
    {
        return $this->hasMany(InsurancePlanPrivate::class);
    }

    /**
     * InsurancePlan has many InsurePlanServices.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insurancePlanServices()
    {
        return $this->hasMany(InsurancePlanService::class);
    }

    /**
     * InsurancePlan has many InsurePolicies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insurancePolicies()
    {
        return $this->hasMany(InsurancePolicy::class);
    }

    /**
     * InsurancePlan has many EntityTimeFailed.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timeFaileds()
    {
        return $this->morphMany(EntityTimeFailed::class, 'time_failable');
    }

    /**
     * InsurancePlan belongs to Patients.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class)->withPivot('status')->withTimestamps();
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
     * The billingCompanies that belong to the insurancePlan.
     *
     * @return BelongsToMany
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The procedures that belongs to the InsurancePlan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function procedures(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class)->withPivot('price', 'price_percentage', 'insurance_label_fee_id')->withTimestamps();
    }

    /**
     * InsurancePlan morphs one PublicNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function publicNote()
    {
        return $this->morphOne(PublicNote::class, 'publishable');
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

    /**
     * InsurancePlan morphs many EntityAbbreviations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function abbreviations()
    {
        return $this->morphMany(EntityAbbreviation::class, 'abbreviable');
    }

    /**
     * InsurancePlan morphs many Contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * InsurancePlan morphs many Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Interact with the insurancePlan's name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }

    public function getLastModifiedAttribute()
    {
        $record = [
            'user'  => '',
            'roles' => [],
        ];
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return [
                'user'  => 'Console',
                'roles' => [],
            ];
        } else {
            $user = User::with(['profile', 'roles'])->find($lastModified->user_id);
            return [
                'user'  => $user->profile->first_name . ' ' . $user->profile->last_name,
                'roles' => $user->roles,
            ];
        }
    }
}
