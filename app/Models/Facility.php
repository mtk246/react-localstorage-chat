<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOne as HasOneAlias;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\Facility
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
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BillingCompany[] $billingCompanies
 * @property-read int|null $billing_companies_count
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Contact|null $contact
 * @property-read mixed $status
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
 * @mixin \Eloquent
 */
class Facility extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = "facilities";

    protected $fillable = [
        "code",
        "name",
        "npi",
        "facility_type_id",
        "nppes_verified_at",
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status', 'last_modified', 'verified_on_nppes'];

    /**
     * Facility belongs to FacilityType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facilityType(): BelongsTo
    {
        return $this->belongsTo(FacilityType::class);
    }

    /**
     * The billingCompanies that belong to the company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The companies that belong to the facility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    /**
     * The healthProfessionals that belong to the Facility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function healthProfessionals(): BelongsToMany
    {
        return $this->belongsToMany(HealthProfessional::class)->withTimestamps();
    }

    /**
     * The PlaceOfServices that belong to the Facility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function placeOfServices(): BelongsToMany
    {
        return $this->belongsToMany(PlaceOfService::class)->withTimestamps()->withPivot('billing_company_id');
    }

    /**
     * The taxonomies that belong to the Facility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
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
     * Interact with the user's name.
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

     /*
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

    public function getVerifiedOnNppesAttribute()
    {
        return isset($this->nppes_verified_at) ? true : false;
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

    public function scopeSearch($query, $search)
    {
        if ($search != "") {
            return $query->whereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")])
                         ->orWhereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")])
                         ->orWhereRaw('LOWER(npi) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }
}
