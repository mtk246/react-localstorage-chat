<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\EntityAbbreviation.
 *
 * @property int $id
 * @property string $abbreviation
 * @property string $abbreviable_type
 * @property int $abbreviable_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property Model|\Eloquent $abbreviable
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany $billingCompany
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereAbbreviableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereAbbreviableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereAbbreviation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityAbbreviation whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class EntityAbbreviation extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'abbreviation',
        'abbreviable_type',
        'abbreviable_id',
        'billing_company_id',
    ];

    /**
     * EntityAbbreviation belongs to BillingCompany.
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * EntityAbbreviation morphs to models in abbreviable_type.
     */
    public function abbreviable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Interact with the entityAbbreviation's abbreviation.
     */
    protected function nickname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }
}
