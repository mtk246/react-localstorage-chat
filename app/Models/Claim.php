<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Claim extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "qr_claim",
        "control_number",
        "submitter_name",
        "submitter_contact",
        "submitter_phone",
        "company_id",
        "facility_id",
        "subscriber_id",
        "insurance_company_id"
    ];

    /**
     * Claim has many ClaimServiceLine.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimServiceLines()
    {
        return $this->hasMany(ClaimServiceLine::class);
    }

    /**
     * Claim has many ClaimDate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimDates()
    {
        return $this->hasMany(ClaimDate::class);
    }
}
