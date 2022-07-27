<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
     * Procedure has many ProcedureCosiderations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureCosiderations()
    {
        return $this->hasMany(ProcedureCosideration::class);
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

    /**
     * The insurancePlan that belong to the Procedure. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePlans()
    {
        return $this->belongsToMany(InsurancePlan::class)->withPivot('price', 'price_percentage')->withTimestamps();
    }

    /**
     * Procedure morphs one publicNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function publicNote()
    {
        return $this->morphOne(PublicNote::class, 'publishable');
    }

    /**
     * Interact with the procedure's description.
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
