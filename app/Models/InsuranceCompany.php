<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\InsuranceCompany
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $file_method
 * @property string $naic
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $status
 * @property-read \App\Models\Address|null $address
 * @property-read \App\Models\Contact|null $contact
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InsurancePlan[] $insurancePlan
 * @property-read int|null $insurance_plan_count
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereFileMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereNaic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompany whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InsuranceCompany extends Model
{
    use HasFactory;

    protected $table = "insurance_companies";

    protected $fillable = [
        "code",
        "name",
        "naic",
        "file_method",
        "status"
    ];

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
     * @return HasMany
     */
    public function insurancePlan(): HasMany
    {
        return $this->hasMany(InsurancePlan::class);
    }
}
