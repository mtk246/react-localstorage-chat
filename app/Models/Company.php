<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $npi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $email
 * @property int $tax_id
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BillingCompany[] $billingCompanies
 * @property-read int|null $billing_companies_count
 * @property-read \App\Models\Contact|null $contact
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Facility[] $facilities
 * @property-read int|null $facilities_count
 * @property-read mixed $status
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereNpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Company extends Model implements Auditable
{
    use HasFactory, AuditableTrait;
    
    protected $fillable = [
        "code",
        "name",
        "npi",
        "ein",
        "upin",
        "clia",
        "name_suffix_id",
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status', 'edit_name', 'last_modified'];

    /**
     * Company belongs to NameSuffix.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nameSuffix()
    {
        return $this->belongsTo(TypeCatalog::class, "name_suffix_id");
    }

    /**
     * The billingCompanies that belong to the company.
     *
     * @return BelongsToMany
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The procedures that belong to the Company 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function procedures()
    {
        return $this->belongsToMany(Procedure::class)->withPivot('price', 'price_percentage', 'insurance_label_fee_id')->withTimestamps();
    }

    /**
     * The healthProfessionals that belong to the company.
     *
     * @return BelongsToMany
     */
    public function healthProfessionals(): BelongsToMany
    {
        return $this->belongsToMany(HealthProfessional::class)->withTimestamps();
    }

    /**
     * The patients that belong to the company.
     *
     * @return BelongsToMany
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class)->withTimestamps();
    }

    /**
     * The services that belong to the company.
     *
     * @return BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withPivot('status', 'std_price')->withTimestamps();
    }

    /**
     * The facilities that belong to the company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class)->withTimestamps();
    }

    /**
     * The taxonomies that belong to the company.
     *
     * @return BelongsToMany
     */
    public function taxonomies(): BelongsToMany
    {
        return $this->belongsToMany(Taxonomy::class)->withTimestamps();
    }

    /**
     * Company has many claim eligibilities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimEligibilities(): HasMany
    {
        return $this->hasMany(ClaimEligibility::class);
    }

    /**
     * Company has many CompanyStatements.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companyStatements()
    {
        return $this->hasMany(CompanyStatement::class);
    }

    /**
     * Company has many ExceptionInsuranceCompanies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exceptionInsuranceCompanies()
    {
        return $this->hasMany(ExceptionInsuranceCompany::class);
    }

    /**
     * Company morphs many Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Company morphs many Contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * Company morphs many EntityNicknames.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function nicknames()
    {
        return $this->morphMany(EntityNickname::class, 'nicknamable');
    }

    /**
     * Company morphs one publicNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function publicNote()
    {
        return $this->morphOne(PublicNote::class, 'publishable');
    }

    /**
     * Company morphs many privateNotes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function privateNotes()
    {
        return $this->morphMany(PrivateNote::class, 'publishable');
    }

    /*
     * Get the company's status.
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

    public function getEditNameAttribute()
    {
        $names = $this->nicknames;
        if (isset($names) && count($names) > 0) {
            return true;
        } else
            return false;
    }

    /**
     * Interact with the company's name.
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
                          ->orWhereRaw('LOWER(npi) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }
}
