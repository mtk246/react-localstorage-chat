<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


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
