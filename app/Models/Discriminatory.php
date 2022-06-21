<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Discriminatory extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "description"
    ];

    /**
     * Discriminatory has many ModifierConsiderations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modifierConsiderations()
    {
        return $this->hasMany(ModifierConsideration::class);
    }

    /**
     * Discriminatory has many ProcedureConsiderations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureConsiderations()
    {
        return $this->hasMany(ProcedureConsideration::class);
    }
}
