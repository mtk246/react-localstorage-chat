<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class MacLocality extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "mac",
        "locality_number",
        "state",
        "fsa",
        "counties"
    ];

    /**
     * The procedures that belong to the MacLocality. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function procedures()
    {
        return $this->belongsToMany(Procedure::class)->withTimestamps();
    }

    /**
     * MacLocality has many ProcedureFees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureFees()
    {
        return $this->hasMany(ProcedureFee::class);
    }

    /**
     * Interact with the macLocality's state.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function state(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    /**
     * Interact with the macLocality's fsa.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function fsa(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    /**
     * Interact with the macLocality's counties.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function counties(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

}
