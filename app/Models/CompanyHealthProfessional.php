<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\HealthProfessional\AuthorizationType;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CompanyHealthProfessional.
 *
 * @property int $id
 * @property int $company_id
 * @property int $health_professional_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property AsEnumCollection|null $authorization
 * @property int|null $billing_company_id
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property \App\Models\Company $company
 * @property \App\Models\HealthProfessional $healthProfessional
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereAuthorization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereHealthProfessionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessional whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class CompanyHealthProfessional extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        'authorization',
        'company_id',
        'health_professional_id',
        'billing_company_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'authorization' => AsEnumCollection::class.':'.AuthorizationType::class,
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function healthProfessional()
    {
        return $this->belongsTo(HealthProfessional::class);
    }

    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class, 'billing_company_id');
    }
}
