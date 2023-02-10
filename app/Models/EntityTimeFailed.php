<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

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
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * EntityTimeFailed belongs to From.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from()
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
