<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClearingHouse
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BillingCompany[] $billingCompanies
 * @property-read int|null $billing_companies_count
 * @property-read \App\Models\Contact|null $contact
 * @property-read string $status
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereUpdatedAt($value)
 * @property int|null $org_type_id
 * @property int|null $transmission_format_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read int|null $abbreviations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 * @property-read mixed $last_modified
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property-read int|null $nicknames_count
 * @property-read \App\Models\TypeCatalog|null $orgType
 * @property-read \App\Models\TypeCatalog|null $transmissionFormat
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereOrgTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereTransmissionFormatId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @mixin \Eloquent
 */
class ClearingHouse extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "org_type_id",
        "transmission_format_id"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified', 'status'];

    /**
     * ClearingHouse belongs to TransmissionFormat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transmissionFormat(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, "transmission_format_id");
    }

    /**
     * ClearingHouse belongs to OrgType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orgType(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, "org_type_id");
    }

    /**
     * The billingCompanies that belong to the ClearingHouse.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
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
     * ClearingHouse morphs many Contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * ClearingHouse morphs many EntityNicknames.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function nicknames()
    {
        return $this->morphMany(EntityNickname::class, 'nicknamable');
    }

    /**
     * ClearingHouse morphs many EntityAbbreviations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function abbreviations()
    {
        return $this->morphMany(EntityAbbreviation::class, 'abbreviable');
    }

    /**
     * Get the clearingHouse's status.
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

    /**
     * Interact with the clearingHouse's name.
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

    public function getLastModifiedAttribute()
    {
        $record = [
            'user'  => '',
            'roles' => []
        ];
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return [
                'user'       => 'Console',
                'roles'      => []
            ];
        } else {
            $user = User::with(['profile', 'roles'])->find($lastModified->user_id);
            return [
                'user'       => $user->profile->first_name . ' ' . $user->profile->last_name,
                'roles'      => $user->roles
            ];
        }
    }
}
