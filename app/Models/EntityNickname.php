<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

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
    public function billingCompany()
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
