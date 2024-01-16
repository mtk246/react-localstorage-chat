<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Facility.
 *
 * @property int $id
 * @property string $name
 * @property string $npi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $code
 * @property string|null $nppes_verified_at
 * @property string|null $other_name
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property int|null $abbreviations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillClassification> $billClassifications
 * @property int|null $bill_classifications_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property int|null $companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\FacilityType> $facilityTypes
 * @property int|null $facility_types_count
 * @property mixed $last_modified
 * @property mixed $status
 * @property mixed $verified_on_nppes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property int|null $health_professionals_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property int|null $nicknames_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PlaceOfService> $placeOfServices
 * @property int|null $place_of_services_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 * @property \App\Models\PublicNote|null $publicNote
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property int|null $taxonomies_count
 *
 * @method static \Database\Factories\FacilityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility query()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereNpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereNppesVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereOtherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereUpdatedAt($value)
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
        return $this->belongsToMany(Company::class)->using(CompanyFacility::class)->withPivot('billing_company_id')->withTimestamps();
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
        return $this->belongsToMany(PlaceOfService::class)->using(FacilityPlaceOfService::class)->withTimestamps()->withPivot('billing_company_id');
    }

    /**
     * The taxonomies that belong to the Facility.
     */
    public function taxonomies(): BelongsToMany
    {
        return $this->belongsToMany(Taxonomy::class)->using(FacilityTaxonomy::class)->withPivot(['billing_company_id', 'primary'])->withTimestamps();
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
        return $this->belongsToMany(FacilityType::class)->using(FacilityFacilityType::class)->withPivot('bill_classifications');
    }

    /**
     * Facility belongsToMany with BillClassification.
     */
    public function billClassifications(): BelongsToMany
    {
        return $this->belongsToMany(BillClassification::class)->withPivot('bill_classifications');
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
        $billingCompany = auth()->user()?->billingCompanies->first();
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
            $user = User::find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles()?->get(['name'])->pluck('name'),
            ];
        }
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'npi' => $this->npi,
            'companies' => $this->companies->pluck('name'),
            'facilityTypes' => $this->facilityTypes->pluck('type'),
            'billingCompanies.id' => $this->billingCompanies->pluck('id'),
            'billingCompanies.name' => $this->billingCompanies->pluck('name'),
        ];
    }
}
