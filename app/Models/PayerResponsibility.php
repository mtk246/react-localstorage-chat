<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\PayerResponsibility
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property-read int|null $insurance_policies_count
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility query()
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PayerResponsibility whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @mixin \Eloquent
 */
class PayerResponsibility extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "description"
    ];

    /**
     * PayerResponsibility has many InsurancePolicies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insurancePolicies()
    {
        return $this->hasMany(InsurancePolicy::class);
    }
}
