<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
 * @property-read \App\Models\Contact|null $contact
 * @property-read \App\Models\Facility $facility
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
class BillingCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "code",
        "status"
    ];

    protected $table = "billing_companies";

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            "billing_company_users",
            "billing_company_id",
            "user_id"
        );
    }

    /**
     * @return HasOne
     */
    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    /**
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * @return BelongsTo
     */
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}
