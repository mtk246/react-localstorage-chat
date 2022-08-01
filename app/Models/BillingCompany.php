<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\BillingCompany
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property bool $status
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClearingHouse[] $clearingHouses
 * @property-read int|null $clearing_houses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read int|null $companies_count
 * @property-read \App\Models\Contact|null $contact
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Facility[] $facilities
 * @property-read int|null $facilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InsuranceCompany[] $insuranceCompany
 * @property-read int|null $insurance_company_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BillingCompany extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "name",
        "code",
        "status"
    ];

    /**
     * BillingCompany has one Contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    /**
     * BillingCompany has one Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * BillingCompany has many IpRestrictions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ipRestrictions()
    {
        return $this->hasMany(IpRestriction::class);
    }

    /**
     * The users that belong to the BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The companies that belong to the BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The facilities that belong to the BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The clearingHouses that belong to the BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clearingHouses(): BelongsToMany
    {
        return $this->belongsToMany(ClearingHouse::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The healthProfessionals that belong to the BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function healthProfessionals(): BelongsToMany
    {
        return $this->belongsToMany(HealthProfessional::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The patients that belong to the BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The insuranceCompany that belong to the BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insuranceCompany(): BelongsToMany
    {
        return $this->belongsToMany(InsuranceCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The insurancePlan that belong to the BillingCompany.
     *
     * @return BelongsToMany
     */
    public function insurancePlans(): BelongsToMany
    {
        return $this->belongsToMany(InsurancePlan::class)->withPivot('status')->withTimestamps();
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

    public function scopeSearch($query, $search)
    {
        if ($search != "") {
            return $query->whereHas('contact', function ($q) use ($search) {
                            $q->whereRaw('LOWER(email) LIKE (?)', [strtolower("%$search%")]);
                        })->orWhereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")])
                          ->orWhereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }
}
