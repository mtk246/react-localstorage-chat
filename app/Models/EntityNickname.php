<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\EntityNickname.
 *
 * @property int $id
 * @property string $nickname
 * @property string $nicknamable_type
 * @property int $nicknamable_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property Model|\Eloquent $nicknamable
 *
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereNicknamableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereNicknamableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntityNickname whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class EntityNickname extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'nickname',
        'nicknamable_type',
        'nicknamable_id',
        'billing_company_id',
    ];

    /**
     * EntityNickname belongs to BillingCompany.
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * EntityNickname morphs to models in nicknamable_type.
     */
    public function nicknamable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Interact with the entityNickname's nickname.
     */
    protected function nickname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }
}
