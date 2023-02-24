<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\CompanyHealthProfessionalType
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyHealthProfessionalType whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class CompanyHealthProfessionalType extends Model implements Auditable
{
    use HasFactory, AuditableTrait;
    
    protected $fillable = [
        "type"
    ];

    /**
     * Interact with the CompanyHealthProfessionalType's type.
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
