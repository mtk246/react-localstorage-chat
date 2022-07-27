<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class InsuranceLabelFee extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "description",
        "insurance_type_id"
    ];

    /**
     * InsuranceLabelFee belongs to InsuranceType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceType()
    {
        return $this->belongsTo(InsuranceType::class);
    }

    /**
     * InsuranceLabelFee has many ProcedureFees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureFees()
    {
        return $this->hasMany(ProcedureFee::class);
    }

    /**
     * Interact with the insuranceLabelFee's description.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst(strtolower($value)),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }
}
