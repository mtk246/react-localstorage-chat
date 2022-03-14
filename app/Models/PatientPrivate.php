<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientPrivate extends Model
{
    use HasFactory;

    protected $fillable = [
        "reference_num",
        "patient_num",
        "med_num",
        "patient_id",
        "billing_company_id",
    ];


    /**
     * PatientPrivate belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
