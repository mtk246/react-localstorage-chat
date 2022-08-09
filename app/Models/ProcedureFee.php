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
        "fee",
        "insurance_label_fee_id",
        "procedure_id",
        "mac_locality_id",
        "fee_start_date",
        "fee_end_date"
    ];

    /**
     * ProcedureFee belongs to Procedure.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }

    /**
     * ProcedureFee belongs to InsuranceLabelFee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceLabelFee()
    {
        return $this->belongsTo(InsuranceLabelFee::class);
    }

    /**
     * ProcedureFee belongs to MacLocality.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function macLocality()
    {
        return $this->belongsTo(MacLocality::class);
    }
}
