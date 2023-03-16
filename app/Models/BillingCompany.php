<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\BillingCompany.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property bool $status
 * @property \App\Models\Address|null $address
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\ClearingHouse[] $clearingHouses
 * @property int|null $clearing_houses_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property int|null $companies_count
 * @property \App\Models\Contact|null $contact
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Facility[] $facilities
 * @property int|null $facilities_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\InsuranceCompany[] $insuranceCompany
 * @property int|null $insurance_company_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property int|null $users_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereUpdatedAt($value)
 *
 * @property string|null $logo
 * @property string|null $abbreviation
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property int|null $health_professionals_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property int|null $insurance_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property int|null $insurance_plans_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property int|null $ip_restrictions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\KeyboardShortcut> $keyboardShortcuts
 * @property int|null $keyboard_shortcuts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property int|null $patients_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereAbbreviation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompany whereLogo($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\KeyboardShortcut> $keyboardShortcuts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\KeyboardShortcut> $keyboardShortcuts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\KeyboardShortcut> $keyboardShortcuts
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 *
 * @mixin \Eloquent
 */
class BillingCompany extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'name',
        'code',
        'status',
        'logo',
        'abbreviation',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified', 'contact', 'address'];

    /**
     * ClearingHouse morphs many Contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * ClearingHouse morphs many Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
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
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The companies that belong to the BillingCompany.
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The facilities that belong to the BillingCompany.
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The clearingHouses that belong to the BillingCompany.
     */
    public function clearingHouses(): BelongsToMany
    {
        return $this->belongsToMany(ClearingHouse::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The healthProfessionals that belong to the BillingCompany.
     */
    public function healthProfessionals(): BelongsToMany
    {
        return $this->belongsToMany(HealthProfessional::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The patients that belong to the BillingCompany.
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The insuranceCompany that belong to the BillingCompany.
     */
    public function insuranceCompanies(): BelongsToMany
    {
        return $this->belongsToMany(InsuranceCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The insurancePlan that belong to the BillingCompany.
     */
    public function insurancePlans(): BelongsToMany
    {
        return $this->belongsToMany(InsurancePlan::class)->withPivot('status')->withTimestamps();
    }

    /**
     * The keyboard shortcuts that belong to the BillingCompany.
     */
    public function customKeyboardShortcuts(): MorphMany
    {
        return $this->morphMany(CustomKeyboardShortcuts::class, 'shortcutable');
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

    public function scopeSearch($query, $search)
    {
        if ('' != $search) {
            return $query->whereHas('contact', function ($q) use ($search) {
                $q->whereRaw('LOWER(email) LIKE (?)', [strtolower("%$search%")]);
            })->orWhereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")])
                          ->orWhereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
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

    public function getContactAttribute()
    {
        return $this->contacts[0] ?? null;
    }

    public function getAddressAttribute()
    {
        return $this->addresses[0] ?? null;
    }
}
