<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\EntityTimeFailed
 *
 * @property int $id
 * @property int|null $days
 * @property int|null $from_id
 * @property int $billing_company_id
 * @property string $time_failable_type
 * @property int $time_failable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany $billingCompany
 * @property-read \App\Models\TypeCatalog|null $from
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereTimeFailableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereTimeFailableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityTimeFailed whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read Model|\Eloquent $timeFailable
 * @mixin \Eloquent
 */
class EntityTimeFailed extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "days",
        "from_id",
        "billing_company_id",
        "time_failable_type",
        "time_failable_id"
    ];

    /**
     * EntityTimeFailed belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * EntityTimeFailed belongs to From.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'from_id');
    }

    /**
     * EntityTimeFailed morphs to models in time_failable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function timeFailable(): MorphTo
    {
        return $this->morphTo();
    }
}
