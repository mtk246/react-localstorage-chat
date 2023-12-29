<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Address.
 *
 * @property int $id
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $addressable_type
 * @property int $addressable_id
 * @property int|null $address_type_id
 * @property string|null $country
 * @property string|null $country_subdivision_code
 * @property string|null $apt_suite
 * @property \App\Models\AddressType|null $addressType
 * @property Model|\Eloquent $addressable
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property Model|\Eloquent $profile
 * @property Model|\Eloquent $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAptSuite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountrySubdivisionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereZip($value)
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
        'apt_suite',
    ];

    protected $appends = [
        'state_code',
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

    public function user(): MorphTo
    {
        return $this->morphTo(User::class, 'addressable_type', 'addressable_id');
    }

    public function profile(): MorphTo
    {
        return $this->morphTo(Profile::class, 'addressable_type', 'addressable_id');
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

    protected function getStateCodeAttribute(): string
    {
        return explode(' - ', $this->state ?? '')[0] ?? '';
    }

    /**
     * Interact with the apt suite attribute.
     */
    protected function aptSuite(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }
}
