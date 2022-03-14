<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marital extends Model
{
    use HasFactory;

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
}
