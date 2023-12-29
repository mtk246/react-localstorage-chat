<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\PlaceOfService;
use App\Models\Procedure;
use App\Models\TypeCatalog;
use App\Models\TypeOfService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\Services.
 *
 * @property int $id
 * @property int $claim_service_id
 * @property int|null $procedure_id
 * @property array|null $modifier_ids
 * @property array|null $diagnostic_pointers
 * @property string $from_service
 * @property string $to_service
 * @property string $price
 * @property string $total_charge
 * @property string|null $copay
 * @property string|null $revenue_code_id
 * @property string|null $place_of_service_id
 * @property string|null $type_of_service_id
 * @property string|null $days_or_units
 * @property string|null $emg
 * @property string|null $epsdt_id
 * @property string|null $family_planning_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Claims\ClaimService|null $claimService
 * @property TypeCatalog|null $epsdt
 * @property TypeCatalog|null $familyPlanning
 * @property mixed $modifiers
 * @property PlaceOfService|null $placeOfService
 * @property Procedure|null $procedure
 * @property Procedure|null $revenueCode
 * @property TypeOfService|null $typeOfService
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Services newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Services newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Services query()
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereClaimServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereCopay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereDaysOrUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereDiagnosticPointers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereEmg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereEpsdtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereFamilyPlanningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereFromService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereModifierIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services wherePlaceOfServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereRevenueCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereToService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereTotalCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereTypeOfServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Services extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'from_service',
        'to_service',
        'procedure_id',
        'modifier_ids',
        'place_of_service_id',
        'type_of_service_id',
        'diagnostic_pointers',
        'days_or_units',
        'price',
        'copay',
        'emg',
        'epsdt_id',
        'family_planning_id',
        'revenue_code_id',
        'total_charge',
        'claim_service_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'modifier_ids' => 'array',
        'diagnostic_pointers' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['modifiers'];

    /**
     * ClaimService belongs to Procedure.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimService()
    {
        return $this->belongsTo(ClaimService::class);
    }

    /**
     * ClaimService belongs to Procedure.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }

    /**
     * ClaimService belongs to PlaceOfService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function placeOfService()
    {
        return $this->belongsTo(PlaceOfService::class);
    }

    /**
     * ClaimService belongs to TypeOfService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeOfService()
    {
        return $this->belongsTo(TypeOfService::class);
    }

    /**
     * Service belongs to Epsdt.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function epsdt()
    {
        return $this->belongsTo(TypeCatalog::class, 'epsdt_id');
    }

    /**
     * Service belongs to FamilyPlanning.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function familyPlanning()
    {
        return $this->belongsTo(TypeCatalog::class, 'family_planning_id');
    }

    /**
     * Service belongs to RevenueCode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function revenueCode()
    {
        return $this->belongsTo(Procedure::class, 'revenue_code_id');
    }

    public function getModifiersAttribute()
    {
        $modifiers = [];
        foreach ($this->modifier_ids ?? [] as $modId) {
            $mod = \App\Models\Modifier::find($modId);
            array_push($modifiers, [
                'id' => $mod['id'] ?? '',
                'name' => $mod['modifier'] ?? '',
                'start_date' => $mod['start_date'] ?? '',
                'end_date' => $mod['end_date'] ?? '',
                'special_coding_instructions' => $mod['special_coding_instructions'] ?? '',
                'active' => $mod['active'] ?? '',
            ]);
        }

        return $modifiers;
    }
}
