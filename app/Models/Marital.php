<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Marital extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "spuse_name",
        "spuse_work",
        "spuse_work_phone",
        "patient_id"
    ];


    /**
     * Marital belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Interact with the marital's spuses_name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function spuseName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }

    /**
     * Interact with the marital's spuse_work.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function spuseWork(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }
}
