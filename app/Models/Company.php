<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Company.
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $npi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $ein
 * @property string|null $clia
 * @property string|null $other_name
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property int|null $abbreviations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimEligibility> $claimEligibilities
 * @property int|null $claim_eligibilities_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyStatement> $companyStatements
 * @property int|null $company_statements_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractFee> $contracFees
 * @property int|null $contrac_fees_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Copay> $copays
 * @property int|null $copays_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExceptionInsuranceCompany> $exceptionInsuranceCompanies
 * @property int|null $exception_insurance_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property int|null $facilities_count
 * @property bool $edit_name
 * @property array<key, string> $last_modified
 * @property bool|null $status
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property int|null $health_professionals_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property int|null $nicknames_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property int|null $patients_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 * @property \App\Models\PublicNote|null $publicNote
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property int|null $services_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property int|null $taxonomies_count
 *
 * @method static \Database\Factories\CompanyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereClia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereEin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereNpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereOtherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Company extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'name',
        'npi',
        'ein',
        'clia',
        'other_name',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var string[]
     */
    protected $appends = ['status', 'edit_name', 'last_modified'];

    protected function ein(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value
                ? preg_replace('/^(\d{2})(\d{7})$/', '$1-$2', $value)
                : null,
            set: fn (?string $value) => $value
                ? preg_replace('/^(\d{2})-(\d{7})$/', '$1$2', $value)
                : null,
        );
    }

    /**
     * The billingCompanies that belong to the company.
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)
            ->using(BillingCompanyCompany::class)
            ->withPivot(['status', 'miscellaneous', 'claim_format_ids'])
            ->withTimestamps();
    }

    /**
     * The procedures that belong to the Company.
     */
    public function procedures(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class)
            ->using(CompanyProcedure::class)
            ->withPivot(
                'id',
                'price',
                'price_percentage',
                'insurance_label_fee_id',
                'billing_company_id',
                'modifier_id',
                'clia',
                'mac_locality_id',
            )
            ->withTimestamps();
    }

    /**
     * The healthProfessionals that belong to the company.
     */
    public function healthProfessionals(): BelongsToMany
    {
        return $this->belongsToMany(HealthProfessional::class)->withTimestamps();
    }

    /**
     * The patients that belong to the company.
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class)->withPivot('billing_company_id', 'med_num', 'id')->withTimestamps();
    }

    /**
     * The services that belong to the company.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withPivot('status', 'std_price')->withTimestamps();
    }

    /**
     * The facilities that belong to the company.
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class)->withPivot('billing_company_id')->withTimestamps();
    }

    /**
     * The taxonomies that belong to the company.
     */
    public function taxonomies(): BelongsToMany
    {
        return $this->belongsToMany(Taxonomy::class)->withTimestamps();
    }

    /**
     * Company has many claim eligibilities.
     */
    public function claimEligibilities(): HasMany
    {
        return $this->hasMany(ClaimEligibility::class);
    }

    /**
     * Company has many CompanyStatements.
     */
    public function companyStatements(): HasMany
    {
        return $this->hasMany(CompanyStatement::class);
    }

    /**
     * Company has many ExceptionInsuranceCompanies.
     */
    public function exceptionInsuranceCompanies(): HasMany
    {
        return $this->hasMany(ExceptionInsuranceCompany::class);
    }

    /**
     * Company morphs many Address.
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Company morphs many Contact.
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * Company morphs many EntityNicknames.
     */
    public function nicknames(): MorphMany
    {
        return $this->morphMany(EntityNickname::class, 'nicknamable');
    }

    /**
     * Company morphs many EntityAbbreviations.
     */
    public function abbreviations(): MorphMany
    {
        return $this->morphMany(EntityAbbreviation::class, 'abbreviable');
    }

    /**
     * Company morphs one publicNote.
     */
    public function publicNote(): MorphOne
    {
        return $this->morphOne(PublicNote::class, 'publishable');
    }

    /**
     * Company morphs many privateNotes.
     */
    public function privateNotes(): MorphMany
    {
        return $this->morphMany(PrivateNote::class, 'publishable');
    }

    /*
     * Get the company's status.
     */
    public function getStatusAttribute(): ?bool
    {
        $billingCompany = \Auth::user()?->billingCompanies?->first();

        if (is_null($billingCompany)) {
            return null;
        }

        $status = $this->billingCompanies->find($billingCompany->id)?->pivot->status;

        return $status
            ? (bool) $status
            : null;
    }

    /** @return array<key, string> */
    public function getLastModifiedAttribute(): array
    {
        $lastModified = $this->audits()->latest()->first();

        if (isset($lastModified->user_id)) {
            $user = User::with(['profile', 'roles'])->find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles,
            ];
        }

        return [
            'user' => 'Console',
            'roles' => [],
        ];
    }

    public function getEditNameAttribute(): bool
    {
        $names = $this->nicknames;

        return isset($names) && count($names) > 0;
    }

    public function copays(): HasMany
    {
        return $this->hasMany(Copay::class);
    }

    public function contracFees(): HasMany
    {
        return $this->hasMany(ContractFee::class);
    }

    /**
     * Interact with the company's name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }

    /**
     * @todo need to check this hold logic and use cases
     *
     * @codingStandardsIgnoreStart
     */
    public function scopeSearch($query, $search): mixed
    {
        if ('' != $search) {
            return $query->whereHas('contacts', function ($q) use ($search): void {
                $q->whereRaw('LOWER(email) LIKE (?)', [strtolower("%$search%")]);
            })->orWhereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")])
                ->orWhereRaw('LOWER(npi) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }
    // @codingStandardsIgnoreEnd

    public function toSearchableArray()
    {
        $contacts = $this->contacts->first();

        return [
            'code' => $this->code,
            'name' => $this->name,
            'npi' => $this->npi,
            'ein' => $this->ein,
            'clia' => $this->clia,
            'contacts.phone' => $contacts?->phone,
            'contacts.fax' => $contacts?->fax,
            'contacts.email' => $contacts?->email,
            'contacts.mobile' => $contacts?->mobile,
        ];
    }
}
