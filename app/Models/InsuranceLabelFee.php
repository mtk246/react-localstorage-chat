<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\InsuranceLabelFee
 *
 * @property int $id
 * @property string $description
 * @property int $insurance_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\InsuranceType $insuranceType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property-read int|null $procedure_fees_count
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereInsuranceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @mixin \Eloquent
 */
class InsuranceLabelFee extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "description",
        "insurance_type_id"
    ];

    /**
     * InsuranceLabelFee belongs to InsuranceType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceType()
    {
        return $this->belongsTo(InsuranceType::class);
    }

    /**
     * InsuranceLabelFee has many ProcedureFees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureFees()
    {
        return $this->hasMany(ProcedureFee::class);
    }

    /**
     * Interact with the insuranceLabelFee's description.
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
