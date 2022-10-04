<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimEligibilityBenefitsInformation extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "name",
        "service_type_codes",
        "service_types",
        "insurance_type_code",
        "insurance_type",
        "time_qualifer_code",
        "time_qualifer",
        "benefit_amount",
        "benefits_date_information",
        "additional_information",
        "claim_eligibility_id",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'service_type_codes'        => 'array',
        "service_types"             => 'array',
        "benefits_date_information" => 'array',
        "additional_information"    => 'array'
    ];

    /**
     * ClaimEligibilityBenefitsInformation belongs to ClaimEligibility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }
}
