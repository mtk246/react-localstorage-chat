<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InsurancePlanServiceAliance.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\InsurancePlanService|null $insurancePlanService
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanServiceAliance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanServiceAliance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanServiceAliance query()
 *
 * @mixin \Eloquent
 */
class InsurancePlanServiceAliance extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'price',
        'percentage',
        'insurance_plan_service_id',
    ];

    /**
     * InsurancePlanServiceAliance belongs to InsurancePlanService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insurancePlanService()
    {
        return $this->belongsTo(InsurancePlanService::class);
    }
}
