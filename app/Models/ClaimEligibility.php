<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimEligibility extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "control_number",
        "eligibility",
        "company_id",
        "suscriber_id",
        "insurance_company_id"
    ];

    /**
     * ClaimEligibility belongs to Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * ClaimEligibility belongs to Subscriber.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class);
    }

    /**
     * ClaimEligibility belongs to InsuranceCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceCompany(): BelongsTo
    {
        return $this->belongsTo(InsuranceCompany::class);
    }

    /**
     * ClaimEligibility has many claim eligibility benefits informations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimEligibilityBenefitsInformations(): HasMany
    {
        return $this->hasMany(ClaimEligibilityBenefitsInformation::class);
    }

    /**
     * ClaimEligibility has many claim eligibility benefits information others.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimEligibilityBenefitsInformationOthers(): HasMany
    {
        return $this->hasMany(ClaimEligibilityBenefitsInformationOther::class);
    }

    /**
     * ClaimEligibility has many claim eligibility payers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimEligibilityPayers(): HasMany
    {
        return $this->hasMany(ClaimEligibilityPayer::class);
    }

    /**
     * ClaimEligibility has many claim eligibility trace numbers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimEligibilityTraceNumbers(): HasMany
    {
        return $this->hasMany(ClaimEligibilityTraceNumber::class);
    }
}
