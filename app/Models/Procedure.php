<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Procedure extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "description",
        "active",
    ];

    /**
     * Procedure has many ProcedureFees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureFees()
    {
        return $this->hasMany(ProcedureFee::class);
    }

    /**
     * The companies that belong to the Procedure. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    /**
     * The diagnoses that belong to the Procedure. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function diagnoses()
    {
        return $this->belongsToMany(Diagnosis::class)->withTimestamps();
    }

    /**
     * The modifiers that belong to the Procedure. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modifiers()
    {
        return $this->belongsToMany(Modifier::class)->withTimestamps();
    }

    /**
     * The mac localities that belong to the Procedure. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function macLocalities()
    {
        return $this->belongsToMany(MacLocality::class)->withTimestamps();
    }
}
