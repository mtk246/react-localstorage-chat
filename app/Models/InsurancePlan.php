<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Gate;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InsurancePlan.
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
 * @property \App\Models\InsuranceCompany|null $insuranceCompany
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 * @property int|null $patients_count
 *
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
 *
 * @property bool $file_zero_changes
 * @property int|null $charge_using_id
 * @property int|null $ins_type_id
 * @property int|null $plan_type_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property int|null $abbreviations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \App\Models\TypeCatalog|null $chargeUsing
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property mixed $last_modified
 * @property \App\Models\TypeCatalog|null $insType
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanPrivate> $insurancePlanPrivate
 * @property int|null $insurance_plan_private_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property int|null $insurance_plan_services_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property int|null $insurance_policies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property int|null $nicknames_count
 * @property \App\Models\TypeCatalog|null $planType
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 * @property \App\Models\PublicNote|null $publicNote
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property int|null $services_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityTimeFailed> $timeFaileds
 * @property int|null $time_faileds_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereChargeUsingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereFileZeroChanges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan whereInsTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan wherePlanTypeId($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanPrivate> $insurancePlanPrivate
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityTimeFailed> $timeFaileds
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractFee> $contractFees
 * @property int|null $contract_fees_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Copay> $copays
 * @property int|null $copays_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanPrivate> $insurancePlanPrivate
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlanService> $insurancePlanServices
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityTimeFailed> $timeFaileds
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlan search($search)
 *
 * @mixin \Eloquent
 */
class InsurancePlan extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    protected $fillable = [
        'code',
        'name',
        'payer_id',
        'accept_assign',
        'pre_authorization',
        'file_zero_changes',
        'referral_required',
        'accrue_patient_resp',
        'require_abn',
        'pqrs_eligible',
        'allow_attached_files',
        'eff_date',
        'ins_type_id',
        'plan_type_id',
        'charge_using_id',
        'insurance_company_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

    /**
     * InsurancePlan belongs to InsuranceCompany.
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
     * InsurancePlan has many Copays.
     */
    public function copays(): HasMany
    {
        return $this->hasMany(Copay::class);
    }

    /**
     * InsurancePlan has many ContracFees.
     */
    public function contractFees(): HasMany
    {
        return $this->hasMany(ContractFee::class);
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
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class)->withPivot('status')->withTimestamps();
    }

    /**
     * InsurancePlan belongs to Services.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withPivot('price', 'aliance')->withTimestamps();
    }

    /**
     * The billingCompanies that belong to the insurancePlan.
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The procedures that belongs to the InsurancePlan.
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
            'user' => '',
            'roles' => [],
        ];
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return [
                'user' => 'Console',
                'roles' => [],
            ];
        } else {
            $user = User::with(['profile', 'roles'])->find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles,
            ];
        }
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            return $query
                ->where(function ($query) use ($search) {
                    $this->searchByInsurancePlan($query, $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $this->searchByInsuranceCompany($query, $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $this->searchByAbbreviation($query, $search);
                });
        });
    }

    protected function searchByInsurancePlan($query, $search)
    {
        $query->whereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")])
            ->orWhereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")])
            ->orWhereRaw('LOWER(payer_id) LIKE (?)', [strtolower("%$search%")])
            ->orWhereHas('planType', function ($q) use ($search) {
                $q->whereRaw('code LIKE (?)', [strtoupper("%$search%")]);
            })
            ->orWhereHas('insType', function ($q) use ($search) {
                $q->whereRaw('code LIKE (?)', [strtoupper("%$search%")]);
            });
    }

    protected function searchByInsuranceCompany($query, $search)
    {
        $query->whereHas('insuranceCompany', function ($q) use ($search) {
            $q->whereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")]);
        });
    }

    protected function searchByAbbreviation($query, $search)
    {
        $query->whereHas('abbreviations', function ($q) use ($search) {
            $q->when(Gate::denies('is-admin'), function ($query) {
                $user = auth()->user();

                return $query->where('billing_company_id', $user->billingCompanies->first()?->id);
            })
            ->whereRaw('LOWER(abbreviation) LIKE (?)', [strtolower("%$search%")]);
        });
    }

    public function toSearchableArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'public_note' => $this->publicNote?->note,
            'contacts' => $this->contacts->toArray(),
            'addresses' => $this->addresses->toArray(),
        ];
    }
}
