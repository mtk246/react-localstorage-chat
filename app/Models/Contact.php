<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Contact
 *
 * @property int $id
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property int|null $user_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $clearing_house_id
 * @property int|null $facility_id
 * @property int|null $company_id
 * @property int|null $insurance_company_id
 * @property-read \App\Models\BillingCompany|null $billingCompany
 * @property-read \App\Models\ClearingHouse|null $clearingHouse
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Facility|null $facility
 * @property-read \App\Models\InsuranceCompany|null $insuranceCompany
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereClearingHouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUserId($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    use HasFactory;
    protected $table = "contacts";
    protected $fillable = [
        "phone",
        "fax",
        "email",
        "user_id",
        "billing_company_id",
        "company_id",
        "facility_id",
        "clearing_house_id",
        "insurance_company_id",
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * @return BelongsTo
     */
    public function clearingHouse(): BelongsTo
    {
        return $this->belongsTo(ClearingHouse::class);
    }

    /**
     * @return BelongsTo
     */
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return BelongsTo
     */
    public function insuranceCompany(): BelongsTo
    {
        return $this->belongsTo(InsuranceCompany::class);
    }
}
