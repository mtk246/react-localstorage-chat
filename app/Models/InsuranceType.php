<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class InsuranceType extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "description",
    ];

    /**
     * InsuranceType has many InsuranceLabelFees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insuranceLabelFees()
    {
        return $this->hasMany(InsuranceLabelFee::class);
    }

    /**
     * Interact with the insuranceType's description.
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
