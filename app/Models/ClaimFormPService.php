<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


/**
 * App\Models\ClaimFormPService
 *
 * @property int $id
 * @property string|null $from_service
 * @property string|null $to_service
 * @property string|null $price
 * @property array|null $diagnostic_pointers
 * @property int $claim_form_p_id
 * @property int|null $procedure_id
 * @property int|null $place_of_service_id
 * @property int|null $type_of_service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $modifier_ids
 * @property string|null $days_or_units
 * @property string|null $copay
 * @property bool $emg
 * @property int|null $epsdt_id
 * @property int|null $family_planning_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormP $claimFormP
 * @property-read \App\Models\TypeCatalog|null $epsdt
 * @property-read \App\Models\TypeCatalog|null $familyPlanning
 * @property-read mixed $modifiers
 * @property-read \App\Models\PlaceOfService|null $placeOfService
 * @property-read \App\Models\Procedure|null $procedure
 * @property-read \App\Models\TypeOfService|null $typeOfService
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereClaimFormPId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereCopay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereDaysOrUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereDiagnosticPointers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereEmg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereEpsdtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereFamilyPlanningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereFromService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereModifierIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService wherePlaceOfServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereProcedureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereToService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereTypeOfServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormPService whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ClaimFormPService extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "from_service",
        "to_service",
        "procedure_id",
        "modifier_ids",
        "place_of_service_id",
        "type_of_service_id",
        "diagnostic_pointers",
        "days_or_units",
        "price",
        "copay",
        "emg",
        "epsdt_id",
        "family_planning_id",
        "claim_form_p_id",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'modifier_ids'        => 'array',
        'diagnostic_pointers' => 'array'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['modifiers'];

    /**
     * ClaimFormPService belongs to ClaimFormP.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimFormP()
    {
        return $this->belongsTo(ClaimFormP::class);
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
     * ClaimFormPService belongs to Epsdt.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function epsdt()
    {
        return $this->belongsTo(TypeCatalog::class, 'epsdt_id');
    }

    /**
     * ClaimFormPService belongs to FamilyPlanning.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function familyPlanning()
    {
        return $this->belongsTo(TypeCatalog::class, 'family_planning_id');
    }

    public function getModifiersAttribute()
    {
        $modifiers = [];
        foreach ($this->modifier_ids ?? [] as $modId) {
            $mod = Modifier::find($modId);
            array_push($modifiers, [
                "id"                          => $mod["id"] ?? '',
                "name"                        => $mod["modifier"] ?? '',
                "start_date"                  => $mod["start_date"] ?? '',
                "end_date"                    => $mod["end_date"] ?? '',
                "special_coding_instructions" => $mod["special_coding_instructions"] ?? '',
                "active"                      => $mod["active"] ?? ''
            ]);
        }
        return $modifiers;
    }
}
