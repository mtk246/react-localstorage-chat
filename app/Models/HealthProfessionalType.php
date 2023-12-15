<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\HealthProfessional\HealthProfessionalType as HealthProfessionalTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\HealthProfessionalType.
 *
 * @property int $id
 * @property $type
 * @property int|null $health_professional_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property \App\Models\HealthProfessional|null $healthProfessional
 *
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType query()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereHealthProfessionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class HealthProfessionalType extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'type',
        'billing_company_id',
        'health_professional_id',
    ];

    protected $casts = [
        'type' => HealthProfessionalTypeEnum::class,
    ];

    /**
     * HealthProfessionalType has many HealthProfessionals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function healthProfessional()
    {
        return $this->belongsTo(HealthProfessional::class);
    }

    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }
}
