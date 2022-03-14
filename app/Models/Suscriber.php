<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        "ssn",
        "email",
        "first_name",
        "last_name",
        "address",
        "phone",
        "billing_company_id"
    ];

    /**
     * Suscriber belongs to Patients.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function patients()
    {
        return $this->belongsToMany(Patient::class)->withTimestamps();
    }

    /**
     * Suscriber belongs to InsurancePlans.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePlans()
    {
        return $this->belongsToMany(InsurancePlan::class)->withTimestamps();
    }
}
