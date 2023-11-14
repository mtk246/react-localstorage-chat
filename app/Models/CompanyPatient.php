<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\CompanyPatient.
 *
 * @property int $id
 * @property int $company_id
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $med_num
 * @property int|null $billing_company_id
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property \App\Models\Company $company
 * @property \App\Models\Patient $patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPatient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPatient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPatient query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPatient whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPatient whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPatient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPatient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPatient whereMedNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPatient wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyPatient whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class CompanyPatient extends Model
{
    use HasFactory;

    protected $table = 'company_patient';

    protected $fillable = [
        'company_id',
        'patient_id',
        'med_num',
        'billing_company_id',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }
}
