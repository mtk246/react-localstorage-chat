<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


class HealthProfessionalType extends Model implements Auditable
{
    use HasFactory, AuditableTrait;
    
    protected $fillable = [
        "type"
    ];

    /**
     * HealthProfessionalType has many HealthProfessionals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function healthProfessionals()
    {
        return $this->hasMany(HealthProfessional::class);
    }

    /**
     * Interact with the healthProfessionalType's type.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst(strtolower($value)),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }
}
