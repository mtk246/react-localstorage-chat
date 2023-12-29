<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\EntityTimeFailed.
 *
 * @property int $id
 * @property int|null $days
 * @property int|null $from_id
 * @property int $billing_company_id
 * @property string $time_failable_type
 * @property int $time_failable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany $billingCompany
 * @property \App\Models\TypeCatalog|null $from
 * @property Model|\Eloquent $timeFailable
 *
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
 *
 * @mixin \Eloquent
 */
class EntityTimeFailed extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'days',
        'from_id',
        'billing_company_id',
        'time_failable_type',
        'time_failable_id',
    ];

    /**
     * EntityTimeFailed belongs to BillingCompany.
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * EntityTimeFailed belongs to From.
     */
    public function from(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'from_id');
    }

    /**
     * EntityTimeFailed morphs to models in time_failable_type.
     */
    public function timeFailable(): MorphTo
    {
        return $this->morphTo();
    }
}
