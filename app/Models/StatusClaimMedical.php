<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class StatusClaimMedical extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "status_category_code",
        "status_category_code_value",
        "status_code",
        "status_code_value",
        "entity_code",
        "entity",
        "effective_date",
        "submitted_amount",
        "amount_paid",
        "paid_date",
        "check_issue_date",
        "check_number",
        "tracking_number",
        "claim_service_date",
        "trading_partner_claim_number",
        "claim_status_medical_id",
    ];

    /**
     * StatusClaimMedical belongs to ClaimStatusMedical.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimStatusMedical()
    {
        return $this->belongsTo(ClaimStatusMedical::class);
    }
}
