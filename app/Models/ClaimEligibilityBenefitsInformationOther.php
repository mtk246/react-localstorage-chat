<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimEligibilityBenefitsInformationOther extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "claim_eligibility_id",
        "code",
        "name",
        "service_type_codes",
        "service_types",
        "insurance_type_code",
        "insurance_type",
        "header_loop_identifier_code",
        "trailer_loop_identifier_code",
        "plan_number",
        "plan_network_id_number",
        "benefits_date_information",
        "entity_identifier",
        "entity_type",
        "entity_name",
        "address",
        "city",
        "state",
        "postal_code",
        "communication_mode",
        "communication_number"
    ];

    /**
     * ClaimEligibilityBenefitsInformationOther belongs to ClaimEligibility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }
}
