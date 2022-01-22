<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOne as HasOneAlias;

/**
 * App\Models\Facility
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $type
 * @property string $name
 * @property string $company_name
 * @property string $npi
 * @property string $taxonomy
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @property-read \App\Models\Contact $contact
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereNpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereTaxonomy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereUpdatedAt($value)
 */
class Facility extends Model
{
    use HasFactory;

    protected $table = "facilities";

    protected $fillable = [
        "type",
        "name",
        "company_name",
        "npi",
        "taxonomy",
        "billing_company_id",
    ];

    /**
     * @return HasOneAlias
     */
    public function billingCompany(): HasOneAlias
    {
        return $this->hasOne(BillingCompany::class);
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
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
