<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Facility.
 *
 * @property int $id
 * @property int $type
 * @property string $name
 * @property string $company_name
 * @property string $npi
 * @property string $taxonomy
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $company_id
 * @property \App\Models\Address|null $address
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\BillingCompany[] $billingCompanies
 * @property int|null $billing_companies_count
 * @property \App\Models\Company|null $company
 * @property \App\Models\Contact|null $contact
 * @property mixed $status
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility query()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereNpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereTaxonomy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereUpdatedAt($value)
 *
 * @property int $facility_type_id
 * @property string $code
 * @property string|null $nppes_verified_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property int|null $abbreviations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property int|null $companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property \App\Models\FacilityType $facilityType
 * @property mixed $last_modified
 * @property mixed $verified_on_nppes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property int|null $health_professionals_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property int|null $nicknames_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlaceOfService> $placeOfServices
 * @property int|null $place_of_services_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property int|null $taxonomies_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Facility search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereFacilityTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereNppesVerifiedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlaceOfService> $placeOfServices
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlaceOfService> $placeOfServices
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 *
 * @mixin \Eloquent
 */
class Facility extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    protected $table = 'facilities';

    protected $fillable = [
        'code',
        'name',
        'npi',
        'facility_type_id',
        'nppes_verified_at',
        'other_name',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status', 'last_modified', 'verified_on_nppes'];

    /**
     * Facility belongs to FacilityType.
     */
    public function facilityType(): BelongsTo
    {
        return $this->belongsTo(FacilityType::class);
    }

    /**
     * The billingCompanies that belong to the company.
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The companies that belong to the facility.
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)->withPivot('billing_company_id')->withTimestamps();
    }

    /**
     * The healthProfessionals that belong to the Facility.
     */
    public function healthProfessionals(): BelongsToMany
    {
        return $this->belongsToMany(HealthProfessional::class)->withTimestamps();
    }

    /**
     * The PlaceOfServices that belong to the Facility.
     */
    public function placeOfServices(): BelongsToMany
    {
        return $this->belongsToMany(PlaceOfService::class)->withTimestamps()->withPivot('billing_company_id');
    }

    /**
     * The taxonomies that belong to the Facility.
     */
    public function taxonomies(): BelongsToMany
    {
        return $this->belongsToMany(Taxonomy::class)->withTimestamps();
    }

    /**
     * Facility morphs many Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Facility morphs many Contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * Facility morphs many EntityNicknames.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function nicknames()
    {
        return $this->morphMany(EntityNickname::class, 'nicknamable');
    }

    /**
     * Facility morphs many EntityAbbreviations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function abbreviations()
    {
        return $this->morphMany(EntityAbbreviation::class, 'abbreviable');
    }

    /**
     * Facility morphs one publicNote.
     */
    public function publicNote(): MorphOne
    {
        return $this->morphOne(PublicNote::class, 'publishable');
    }

    /**
     * Facility morphs many privateNotes.
     */
    public function privateNotes(): MorphMany
    {
        return $this->morphMany(PrivateNote::class, 'publishable');
    }

    /**
     * Facility belongsToMany with FacilityType.
     */
    public function facilityTypes(): BelongsToMany
    {
        return $this->belongsToMany(FacilityType::class);
    }

    /**
     * Facility belongsToMany with BillClassification.
     */
    public function billClassifications(): BelongsToMany
    {
        return $this->belongsToMany(BillClassification::class);
    }

    /**
     * Interact with the user's name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }

     /*
     * Get the insuranceCompany's status.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute()
    {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) {
            return false;
        }

        return $this->billingCompanies->find($billingCompany->id)->pivot->status ?? false;
    }

    public function getVerifiedOnNppesAttribute()
    {
        return isset($this->nppes_verified_at) ? true : false;
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
        if ('' != $search) {
            return $query->whereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")])
                ->orWhereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")])
                ->orWhereRaw('LOWER(npi) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }

    public function toSearchableArray()
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'npi' => $this->npi,
        ];
    }
}
