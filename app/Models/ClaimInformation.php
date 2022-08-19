<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimInformation extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "claim_filing_code",
        "claim_number",
        "patient_weight",
        "patient_control_number",
        "claim_charge_amount",
        "claim_frequency_code",
        "benefits_assignment",
        "release_information_code",
        "patient_amount_paid",
        "additional_information",
        "claim_id",
        "patient_id",
        "place_of_service_id",
        "claim_plan_participation_code_id"
    ];

    /**
     * ClaimInformation belongs to Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claim(): BelongsTo
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * ClaimInformation belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * ClaimInformation belongs to PlaceOfService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function placeOfService(): BelongsTo
    {
        return $this->belongsTo(PlaceOfService::class);
    }

    /**
     * ClaimInformation belongs to ClaimPlanParticipationCode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimPlanParticipationCode(): BelongsTo
    {
        return $this->belongsTo(ClaimPlanParticipationCode::class);
    }
}
