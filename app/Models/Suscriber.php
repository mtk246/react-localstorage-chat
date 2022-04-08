<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Suscriber extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "ssn",
        "first_name",
        "last_name",
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

    /**
     * User morphs many Contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    /**
     * User morphs many Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
