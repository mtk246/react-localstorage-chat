<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InsuranceLabelFee.
 *
 * @property int $id
 * @property string $description
 * @property int $insurance_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\InsuranceType $insuranceType
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property int|null $procedure_fees_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereInsuranceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceLabelFee whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class InsuranceLabelFee extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'description',
        'insurance_type_id',
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
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst(strtolower($value)),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }
}
