<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class InsuranceCompanyPrivate extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "day_count",
        "from_id",
        "billing_company_id",
    ];

    /**
     * InsuranceCompanyPrivate belongs to From.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from()
    {
        return $this->belongsTo(TypeCatalog::class);
    }

    /**
     * InsuranceCompanyPrivate belongs to BillingCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }
}
