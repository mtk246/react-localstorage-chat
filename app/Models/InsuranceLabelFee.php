<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
