<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\InsuranceType.
 *
 * @property int $id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceLabelFee> $insuranceLabelFees
 * @property int|null $insurance_label_fees_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class InsuranceType extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'description',
    ];

    /**
     * InsuranceType has many InsuranceLabelFees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insuranceLabelFees()
    {
        return $this->hasMany(InsuranceLabelFee::class);
    }

    /**
     * Interact with the insuranceType's description.
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst(strtolower($value)),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }
}
