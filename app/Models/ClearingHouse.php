<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\ClearingHouse
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \App\Models\Contact|null $contact
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClearingHouse whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClearingHouse extends Model
{
    use HasFactory;

    protected $table = "clearing_houses";
    protected $fillable = [
        "code",
        "name"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status'];

    /**
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * @return HasOne
     */
    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
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
     * Get the insuranceCompany's status.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute()
    {
        $billingCompany = auth()->user()->billingCompanyUser->first();
        if (is_null($billingCompany)) return false;
        return $this->billingCompanies->find($billingCompany->id)->pivot->status ?? false;
    }
}
