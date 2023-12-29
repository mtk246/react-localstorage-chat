<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InsurancePlanPrivate.
 *
 * @property int $id
 * @property string|null $naic
 * @property int|null $file_method_id
 * @property int|null $insurance_plan_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $format_professional_id
 * @property int|null $format_cms_id
 * @property int|null $format_institutional_id
 * @property int|null $format_ub_id
 * @property array|null $responsibilities
 * @property string|null $eff_date
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property \App\Models\TypeCatalog|null $fileMethod
 * @property \App\Models\TypeCatalog|null $formatCMS
 * @property \App\Models\TypeCatalog|null $formatInstitutional
 * @property \App\Models\TypeCatalog|null $formatProfessional
 * @property \App\Models\TypeCatalog|null $formatUB
 * @property \App\Models\InsurancePlan|null $insurancePlan
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereEffDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFileMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFormatCmsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFormatInstitutionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFormatProfessionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereFormatUbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereNaic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereResponsibilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanPrivate whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class InsurancePlanPrivate extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'naic',
        'format_professional_id',
        'format_institutional_id',
        'format_cms_id',
        'format_ub_id',
        'file_method_id',
        'billing_company_id',
        'insurance_plan_id',
        'responsibilities',
        'eff_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'responsibilities' => 'json',
    ];

    /**
     * InsurancePlanPrivate belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * InsurancePlanPrivate belongs to InsurancePlan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insurancePlan()
    {
        return $this->belongsTo(InsurancePlan::class);
    }

    /**
     * InsurancePlanPrivate belongs to FormatProfessional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formatProfessional()
    {
        return $this->belongsTo(TypeCatalog::class, 'format_professional_id');
    }

    /**
     * InsurancePlanPrivate belongs to FormatInstitutional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formatInstitutional()
    {
        return $this->belongsTo(TypeCatalog::class, 'format_institutional_id');
    }

    /**
     * InsurancePlanPrivate belongs to FormatCMS.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formatCMS()
    {
        return $this->belongsTo(TypeCatalog::class, 'format_cms_id');
    }

    /**
     * InsurancePlanPrivate belongs to FormatUB.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formatUB()
    {
        return $this->belongsTo(TypeCatalog::class, 'format_ub_id');
    }

    /**
     * InsurancePlanPrivate belongs to FileMethod.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fileMethod()
    {
        return $this->belongsTo(TypeCatalog::class, 'file_method_id');
    }
}
