<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimStatusMedical
 *
 * @property int $id
 * @property string $control_number
 * @property int $company_id
 * @property int $subscriber_id
 * @property int $insurance_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\InsuranceCompany $insuranceCompany
 * @property-read \App\Models\Subscriber $subscriber
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereControlNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereSubscriberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ClaimStatusMedical extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "control_number",
        "company_id",
        "subscriber_id",
        "insurance_company_id"
    ];

    /**
     *  ClaimStatusMedical belongs to Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     *  ClaimStatusMedical belongs to Subscriber.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    /**
     *  ClaimStatusMedical belongs to InsuranceCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class);
    }
}
