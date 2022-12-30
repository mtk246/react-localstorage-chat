<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class EntityAbbreviation extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "abbreviation",
        "abbreviable_type",
        "abbreviable_id",
        "billing_company_id"
    ];

    /**
     * EntityAbbreviation belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * EntityAbbreviation morphs to models in abbreviable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function abbreviable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Interact with the entityAbbreviation's abbreviation.
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
