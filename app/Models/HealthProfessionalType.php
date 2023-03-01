<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


/**
 * App\Models\HealthProfessionalType
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property-read int|null $health_professionals_count
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType query()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessionalType whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @mixin \Eloquent
 */
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
