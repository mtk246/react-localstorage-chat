<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimStatusMedical.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Company $company
 * @property \App\Models\InsuranceCompany $insuranceCompany
 * @property \App\Models\Subscriber $subscriber
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatusMedical query()
 *
 * @mixin \Eloquent
 */
class ClaimStatusMedical extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'control_number',
        'company_id',
        'subscriber_id',
        'insurance_company_id',
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
