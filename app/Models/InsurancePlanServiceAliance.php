<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\InsurancePlanServiceAliance
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\InsurancePlanService|null $insurancePlanService
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanServiceAliance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanServiceAliance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanServiceAliance query()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class InsurancePlanServiceAliance extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "price",
        "percentage",
        "insurance_plan_service_id",
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
