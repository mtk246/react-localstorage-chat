<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\InsuranceCompany
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $file_method
 * @property string $naic
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BillingCompany[] $billingCompanies
 * @property-read int|null $billing_companies_count
 * @property-read \App\Models\Contact|null $contact
 * @property-read string $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InsurancePlan[] $insurancePlan
 * @property-read int|null $insurance_plan_count
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereFileMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereNaic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereUpdatedAt($value)
 * @property string|null $payer_id
 * @property int|null $file_method_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read int|null $abbreviations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $appealReasons
 * @property-read int|null $appeal_reasons_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $billingIncompleteReasons
 * @property-read int|null $billing_incomplete_reasons_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read int|null $claim_eligibilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 * @property-read \App\Models\TypeCatalog|null $fileMethod
 * @property-read mixed $last_modified
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompanyTimeFailed> $insuranceCompanyTimeFaileds
 * @property-read int|null $insurance_company_time_faileds_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read int|null $insurance_plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read int|null $nicknames_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read int|null $private_notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read int|null $procedures_count
 * @property-read \App\Models\PublicNote $publicNote
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereFileMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany wherePayerId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $appealReasons
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $billingIncompleteReasons
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompanyTimeFailed> $insuranceCompanyTimeFaileds
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $appealReasons
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $billingIncompleteReasons
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompanyTimeFailed> $insuranceCompanyTimeFaileds
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @mixin \Eloquent
 */
class InsuranceCompany extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "naic",
        "payer_id",
        "file_method_id"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status', 'last_modified'];

    /**
     * InsuranceCompany belongs to FileMethod.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fileMethod()
    {
        return $this->belongsTo(TypeCatalog::class, 'file_method_id');
    }

    /**
     * InsuranceCompany has many claim eligibilities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimEligibilities(): HasMany
    {
        return $this->hasMany(ClaimEligibility::class);
    }

    /**
     * InsuranceCompany has many InsurancePlans.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insurancePlans(): HasMany
    {
        return $this->hasMany(InsurancePlan::class);
    }

    /**
     * InsuranceCompany has many InsuranceCompanyTimeFailed.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insuranceCompanyTimeFaileds()
    {
        return $this->hasMany(InsuranceCompanyTimeFailed::class);
    }

    /**
     * The billingCompanies that belong to the insuranceCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The procedures that belongs to the InsuranceCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function procedures(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class)->withTimestamps();
    }

    /**
     * The billing incomplete reasons that belongs to the InsuranceCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function billingIncompleteReasons(): BelongsToMany
    {
        return $this->belongsToMany(TypeCatalog::class, 'insurance_company_billing_incomplete_reason', 'insurance_company_id', 'billing_incomplete_reason_id')->using(InsuranceCompanyBillingIncompleteReason::class)->withPivot('billing_company_id')->withTimestamps();
    }

    /**
     * The billing incomplete reasons that belongs to the InsuranceCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function appealReasons(): BelongsToMany
    {
        return $this->belongsToMany(TypeCatalog::class, 'insurance_company_appeal_reason', 'insurance_company_id', 'appeal_reason_id')->using(InsuranceCompanyAppealReason::class)->withPivot('billing_company_id')->withTimestamps();
    }

    /**
     * InsuranceCompany morphs many Contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * InsuranceCompany morphs many Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * InsuranceCompany morphs many EntityNicknames.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function nicknames()
    {
        return $this->morphMany(EntityNickname::class, 'nicknamable');
    }

    /**
     * InsuranceCompany morphs many EntityAbbreviations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function abbreviations()
    {
        return $this->morphMany(EntityAbbreviation::class, 'abbreviable');
    }

    /**
     * InsuranceCompany morphs many PublicNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function publicNote()
    {
        return $this->morphOne(PublicNote::class, 'publishable');
    }

    /**
     * InsuranceCompany morphs many privateNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function privateNotes()
    {
        return $this->morphMany(PrivateNote::class, 'publishable');
    }

    /**
     * Get the insuranceCompany's status.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute()
    {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return false;
        return $this->billingCompanies->find($billingCompany->id)->pivot->status ?? false;
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

    /**
     * Interact with the insuranceCompany's name.
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

    public function scopeSearch($query, $search)
    {
        if ($search != "") {
            return $query->whereHas('contacts', function ($q) use ($search) {
                            $q->whereRaw('LOWER(email) LIKE (?)', [strtolower("%$search%")]);
                        })->orWhereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")])
                          ->orWhereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }
}
