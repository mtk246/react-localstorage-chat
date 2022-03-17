<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Employment extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "employer_name",
        "employer_address",
        "employer_phone",
        "position",
        "patient_id"
    ];


    /**
     * Employment belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
