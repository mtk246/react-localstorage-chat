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
 * App\Models\EntityNickname
 *
 * @property int $id
 * @property string $nickname
 * @property string $nicknamable_type
 * @property int $nicknamable_id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\BillingCompany|null $billingCompany
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class EntityNickname extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "nickname",
        "nicknamable_type",
        "nicknamable_id",
        "billing_company_id"
    ];

    /**
     * EntityNickname belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * EntityNickname morphs to models in nicknamable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function nicknamable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Interact with the entityNickname's nickname.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function nickname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }
}
