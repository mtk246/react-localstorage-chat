<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Address.
 *
 * @property int $id
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property int|null $user_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $clearing_house_id
 * @property int|null $facility_id
 * @property int|null $company_id
 * @property int|null $insurance_company_id
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property \App\Models\ClearingHouse|null $clearingHouse
 * @property \App\Models\Company|null $company
 * @property \App\Models\Facility|null $facility
 * @property \App\Models\InsuranceCompany|null $insuranceCompany
 * @property \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereClearingHouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereZip($value)
 *
 * @property string $addressable_type
 * @property int $addressable_id
 * @property int|null $address_type_id
 * @property string|null $country
 * @property string|null $country_subdivision_code
 * @property \App\Models\AddressType|null $addressType
 * @property Model|\Eloquent $addressable
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountrySubdivisionCode($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 *
 * @mixin \Eloquent
 */
class Address extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'address',
        'city',
        'state',
        'zip',
        'address_type_id',
        'country',
        'country_subdivision_code',
        'billing_company_id',
        'addressable_type',
        'addressable_id',
    ];

    /**
     * Address belongs to AddressType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function addressType()
    {
        return $this->belongsTo(AddressType::class);
    }

    /**
     * Address belongs to BillingCompany.
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * Address morphs to models in addressable_type.
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Interact with the user's address.
     */
    protected function address(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }

    /**
     * Interact with the user's city.
     */
    protected function city(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }
}
