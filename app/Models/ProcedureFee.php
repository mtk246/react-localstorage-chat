<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ProcedureFee extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "label",
        "fee",
        "insurance_type_id",
        "procedure_id"
    ];

    /**
     * ProcedureFee belongs to InsuranceType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceType()
    {
        return $this->belongsTo(InsuranceType::class);
    }

    /**
     * ProcedureFee belongs to Procedure.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }
}
