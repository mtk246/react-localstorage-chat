<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Reports\Preset;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Scout\Searchable;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
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
 * @property string|null $logo
 * @property string|null $abbreviation
 * @property string|null $tax_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClearingHouse> $clearingHouses
 * @property int|null $clearing_houses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property int|null $companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\CustomKeyboardShortcuts> $customKeyboardShortcuts
 * @property int|null $custom_keyboard_shortcuts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property int|null $facilities_count
 * @property mixed $address
 * @property mixed $contact
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property int|null $health_professionals_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property int|null $insurance_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property int|null $insurance_plans_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property int|null $ip_restrictions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property int|null $patients_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Preset> $presets
 * @property int|null $presets_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property int|null $users_count
 *
 * @method static \Database\Factories\BillingCompanyFactory factory($count = null, $state = [])
 * @method static Builder|BillingCompany newModelQuery()
 * @method static Builder|BillingCompany newQuery()
 * @method static Builder|BillingCompany query()
 * @method static Builder|BillingCompany search($search)
 * @method static Builder|BillingCompany whereAbbreviation($value)
 * @method static Builder|BillingCompany whereCode($value)
 * @method static Builder|BillingCompany whereCreatedAt($value)
 * @method static Builder|BillingCompany whereId($value)
 * @method static Builder|BillingCompany whereLogo($value)
 * @method static Builder|BillingCompany whereName($value)
 * @method static Builder|BillingCompany whereStatus($value)
 * @method static Builder|BillingCompany whereTaxId($value)
 * @method static Builder|BillingCompany whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class BillingCompany extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    protected $fillable = [
        'tax_id',
        'name',
        'code',
        'status',
        'logo',
        'abbreviation',
    ];

    public function abbreviation(): Attribute
    {
        return Attribute::make(set: fn (string $value) => strtoupper($value));
    }

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

    public function presets(): HasMany
    {
        return $this->hasMany(Preset::class);
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

    public function scopeSearch($query, $search)
    {
        if ('' != $search) {
            return $query->whereHas('contacts', function ($q) use ($search) {
                $q->whereRaw('LOWER(email) LIKE (?)', [strtolower("%$search%")]);
            })
            ->orWhereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")])
            ->orWhereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")])
            ->orWhereRaw('LOWER(tax_id) LIKE (?)', [strtolower("%$search%")])
            ->orWhereRaw('LOWER(abbreviation) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }

    public function getLastModifiedAttribute()
    {
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return [
                'user' => 'Console',
                'roles' => [],
            ];
        } else {
            $user = User::find($lastModified->user_id);

            $firstName = $user->profile->first_name ?? '';
            $lastName = $user->profile->last_name ?? '';

            return [
                'user' => $firstName.' '.$lastName,
                'roles' => $user->roles()?->get(['name'])->pluck('name'),
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

    public function toSearchableArray()
    {
        return [
            'tax_id' => $this->tax_id,
            'name' => $this->name,
            'code' => $this->code,
            'icon' => $this->logo,
            'abbreviation' => $this->abbreviation,
            'contact.email' => $this->contact?->email ?? null,
        ];
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->query()
            ->when(is_numeric($value), function (Builder $query) use ($value): void {
                $query->Where('id', $value)->orWhere('tax_id', $value);
            }, function (Builder $query) use ($value): void {
                $query->where('name', $value)->orWhere('code', $value);
            })
            ->firstOrFail();
    }
}
