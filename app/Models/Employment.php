<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Employment.
 *
 * @property int $id
 * @property string|null $employer_name
 * @property string|null $employer_address
 * @property string|null $employer_phone
 * @property string|null $position
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $billing_company_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property \App\Models\Patient $patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Employment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employment whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Employment extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'employer_name',
        'employer_address',
        'employer_phone',
        'position',
        'patient_id',
        'billing_company_id',
    ];

    /**
     * Employment belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the billingCompany that owns the Employment.
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }
}
