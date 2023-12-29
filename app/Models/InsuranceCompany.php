<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Gate;
use Laravel\Scout\Searchable;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InsuranceCompany.
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $naic
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $payer_id
 * @property int|null $file_method_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property int|null $abbreviations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $appealReasons
 * @property int|null $appeal_reasons_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\TypeCatalog> $billingIncompleteReasons
 * @property int|null $billing_incomplete_reasons_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property int|null $claim_eligibilities_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property \App\Models\TypeCatalog|null $fileMethod
 * @property mixed $last_modified
 * @property string $status
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompanyTimeFailed> $insuranceCompanyTimeFaileds
 * @property int|null $insurance_company_time_faileds_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property int|null $insurance_plans_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property int|null $nicknames_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 * @property \App\Models\PublicNote $publicNote
 *
 * @method static \Database\Factories\InsuranceCompanyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereFileMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereNaic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany wherePayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class InsuranceCompany extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    protected $fillable = [
        'code',
        'name',
        'naic',
        'payer_id',
        'file_method_id',
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
     */
    public function claimEligibilities(): HasMany
    {
        return $this->hasMany(ClaimEligibility::class);
    }

    /**
     * InsuranceCompany has many InsurancePlans.
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
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The procedures that belongs to the InsuranceCompany.
     */
    public function procedures(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class)->withTimestamps();
    }

    /**
     * The billing incomplete reasons that belongs to the InsuranceCompany.
     */
    public function billingIncompleteReasons(): BelongsToMany
    {
        return $this->belongsToMany(TypeCatalog::class, 'insurance_company_billing_incomplete_reason', 'insurance_company_id', 'billing_incomplete_reason_id')->using(InsuranceCompanyBillingIncompleteReason::class)->withPivot('billing_company_id')->withTimestamps();
    }

    /**
     * The billing incomplete reasons that belongs to the InsuranceCompany.
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
     * @return string
     */
    public function getStatusAttribute()
    {
        $billingCompany = auth()->user()?->billingCompanies->first();
        if (is_null($billingCompany)) {
            return false;
        }

        return $this->billingCompanies->find($billingCompany->id)->pivot->status ?? false;
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
            $user = User::find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles()?->get(['name'])->pluck('name'),
            ];
        }
    }

    /**
     * Interact with the insuranceCompany's name.
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
        return $query->when($search, function ($query) use ($search) {
            return $query
                ->where(function ($query) use ($search) {
                    $this->searchByInsuranceCompany($query, $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $this->searchByAbbreviation($query, $search);
                });
        });
    }

    protected function searchByInsuranceCompany($query, $search)
    {
        $query->whereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")])
            ->orWhereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")])
            ->orWhereRaw('LOWER(payer_id) LIKE (?)', [strtolower("%$search%")]);
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
            'naic' => $this->naic,
            'public_note' => $this->publicNote?->note,
            'contacts' => $this->contacts->toArray(),
            'addresses' => $this->addresses->toArray(),
        ];
    }
}
