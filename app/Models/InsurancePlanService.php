<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InsurancePlanService.
 *
 * @property \App\Models\InsurancePlan $insurancePlan
 * @property \App\Models\InsurancePlanServiceAliance|null $insurancePlanServiceAliance
 * @property \App\Models\Service|null $service
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePlanService query()
 *
 * @mixin \Eloquent
 */
class InsurancePlanService extends Model
{
    use HasFactory;

    protected $table = 'insurance_plan_service';

    protected $fillable = [
        'price',
        'aliance',
        'percentage',
        'insurance_plan_id',
        'service_id',
    ];

    protected $with = ['insurancePlanServiceAliance'];

    /**
     * InsurancePlanService belongs to InsurancePlan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insurancePlan()
    {
        return $this->belongsTo(InsurancePlan::class);
    }

    /**
     * InsurancePlanService belongs to Service.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * InsurancePlanService has one InsurancePlanServiceAliance.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function insurancePlanServiceAliance()
    {
        return $this->hasOne(InsurancePlanServiceAliance::class);
    }
}
