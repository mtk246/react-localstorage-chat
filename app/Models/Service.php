<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Service extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "description",
        "group_1",
        "group_2",
        "type",
        "aplicable_to",
        "type_of_service",
        "rev_center",
        "stmt_description",
        "special_instruction",
        "rev_code",
        "use_time_units",
        "ndc_number",
        "units",
        "measure",
        "units_limit",
        "requires_claim_note",
        "requires_supervisor",
        "requires_authorization"
    ];

    /**
     *  Service belongs to InsurancePlans.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePlans(): BelongsToMany
    {
        return $this->belongsToMany(InsurancePlan::class)->withTimestamps();
    }

    /**
     * Service morphs many PublicNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function publicNotes()
    {
        return $this->morphMany(PublicNote::class, 'publishable');
    }

    /**
     * Service morphs many privateNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function privateNotes()
    {
        return $this->morphMany(PrivateNote::class, 'publishable');
    }


}
