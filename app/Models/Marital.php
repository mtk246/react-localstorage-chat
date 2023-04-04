<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\Marital
 *
 * @property int $id
 * @property string $spuse_name
 * @property string|null $spuse_work
 * @property string|null $spuse_work_phone
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|Marital newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marital newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marital query()
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereSpuseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereSpuseWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereSpuseWorkPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marital whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class Marital extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'spuse_name',
        'spuse_work',
        'spuse_work_phone',
        'patient_id',
        'billing_company_id',
    ];

    /**
     * Get the billingCompany that owns the Marital
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }
    /**
     * Marital belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Interact with the marital's spuses_name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function spuseName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }

    /**
     * Interact with the marital's spuse_work.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function spuseWork(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }
}
