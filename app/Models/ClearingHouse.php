<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClearingHouse.
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $org_type_id
 * @property int|null $transmission_format_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityAbbreviation> $abbreviations
 * @property int|null $abbreviations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Address> $addresses
 * @property int|null $addresses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property int|null $contacts_count
 * @property mixed $last_modified
 * @property string $status
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntityNickname> $nicknames
 * @property int|null $nicknames_count
 * @property \App\Models\TypeCatalog|null $orgType
 * @property \App\Models\TypeCatalog|null $transmissionFormat
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereOrgTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereTransmissionFormatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ClearingHouse extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    protected $fillable = [
        'code',
        'name',
        'org_type_id',
        'transmission_format_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified', 'status'];

    /**
     * ClearingHouse belongs to TransmissionFormat.
     */
    public function transmissionFormat(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'transmission_format_id');
    }

    /**
     * ClearingHouse belongs to OrgType.
     */
    public function orgType(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'org_type_id');
    }

    /**
     * The billingCompanies that belong to the ClearingHouse.
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

    /**
     * Interact with the clearingHouse's name.
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

    public function toSearchableArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'contacts' => $this->contacts->toArray(),
            'addresses' => $this->addresses->toArray(),
        ];
    }
}
