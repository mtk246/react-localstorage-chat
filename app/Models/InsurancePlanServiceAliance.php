<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

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
