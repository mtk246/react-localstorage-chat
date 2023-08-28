<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\BillingCompanyHealthProfessional.
 *
 * @property int $id
 * @property bool $status
 * @property int $billing_company_id
 * @property int $health_professional_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $npi_company
 * @property bool $is_provider
 * @property int|null $company_id
 * @property int|null $health_professional_type_id
 * @property string|null $miscellaneous
 * @property \App\Models\BillingCompany $billingCompany
 * @property \App\Models\HealthProfessional $healthProfessional
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional whereHealthProfessionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional whereHealthProfessionalTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional whereIsProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional whereMiscellaneous($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional whereNpiCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyHealthProfessional whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class BillingCompanyHealthProfessional extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = 'billing_company_health_professional';

    protected $fillable = [
        'status',
        'billing_company_id',
        'health_professional_id',
        'npi_company',
        'is_provider',
        'company_id',
        'health_professional_type_id',
        'miscellaneous'
    ];

    public function healthProfessional()
    {
        return $this->belongsTo(HealthProfessional::class);
    }

    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class, 'billing_company_id');
    }
}
