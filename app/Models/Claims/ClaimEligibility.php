<?php

declare(strict_types=1);

namespace App\Models\v2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

final class ClaimEligibility extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'control_number',
        'claim_id',
        'company_id',
        'patient_id',
        'subscriber_id',
        'insurance_policy_id',
        'insurance_company_id',
        'response_details',
        'claim_eligibility_status_id',
    ];

    protected $with = ['claimEligibilityStatus'];

    /**
     * ClaimEligibility belongs to Company.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * ClaimEligibility belongs to Patient.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * ClaimEligibility belongs to Subscriber.
     */
    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class);
    }

    /**
     * ClaimEligibility belongs to InsuranceCompany.
     */
    public function insuranceCompany(): BelongsTo
    {
        return $this->belongsTo(InsuranceCompany::class);
    }

    /**
     * ClaimEligibility belongs to ClaimEligibilityStatus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function claimEligibilityStatus()
    {
        return $this->belongsTo(ClaimEligibilityStatus::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'response_details' => 'array',
    ];
}
