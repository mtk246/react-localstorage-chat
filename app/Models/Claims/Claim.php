<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Enums\Claim\ClaimType;
use App\Enums\Claim\FormatType;
use App\Http\Casts\Claims\AditionalInformationWrapper;
use App\Http\Casts\Claims\ClaimServicesWrapper;
use App\Http\Casts\Claims\DemographicInformationWrapper;
use App\Models\BillingCompany;
use App\Models\InsurancePolicy;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\Claim.
 *
 * @property int $id
 * @property string|null $qr_claim
 * @property string|null $control_number
 * @property string|null $submitter_name
 * @property string|null $submitter_contact
 * @property string|null $submitter_phone
 * @property int|null $company_id
 * @property int|null $facility_id
 * @property int|null $patient_id
 * @property string|null $claim_formattable_type
 * @property int|null $claim_formattable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $validate
 * @property bool $automatic_eligibility
 * @property int|null $billing_provider_id
 * @property int|null $service_provider_id
 * @property int|null $referred_id
 * @property int|null $referred_provider_role_id
 * @property FormatType $format
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property BillingCompany $billingCompany
 * @property \App\Models\Claims\ClaimDateInformation|null $dateInformation
 * @property \App\Models\Claims\ClaimDemographicInformation|null $demographicInformation
 * @property \Illuminate\Database\Eloquent\Collection<int, InsurancePolicy> $insurancePolicies
 * @property int|null $insurance_policies_count
 * @property \App\Models\Claims\PatientAdditionalInformation|null $patientInformation
 * @property \App\Models\Claims\ClaimServices|null $services
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimStatus> $status
 * @property int|null $status_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimSubStatus> $subStatus
 * @property int|null $sub_status_count
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereAutomaticEligibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereBillingProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereClaimFormattableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereClaimFormattableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereControlNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereQrClaim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereReferredId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereReferredProviderRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereServiceProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereSubmitterContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereSubmitterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereSubmitterPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereValidate($value)
 * @property ClaimType $type
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, InsurancePolicy> $insurancePolicies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimStatus> $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimSubStatus> $subStatus
 * @mixin \Eloquent
 */
class Claim extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;
    use HasUlids;

    protected $fillable = [
        'code',
        'type',
        'format',
        'submitter_name',
        'submitter_contact',
        'submitter_phone',
        'billing_company_id',
    ];

    protected $casts = [
        'type' => ClaimType::class,
        'format' => FormatType::class,
    ];

    /**
     * The insurance policies that belong to the Claim.
     */
    public function insurancePolicies(): BelongsToMany
    {
        return $this->belongsToMany(InsurancePolicy::class, 'claim_insurance_policy', 'claim_id', 'insurance_policy_id')->withPivot('order')->withTimestamps();
    }

    public function demographicInformation(): HasOne
    {
        return $this->hasOne(ClaimDemographicInformation::class);
    }

    public function services(): HasOne
    {
        return $this->hasOne(ClaimServices::class);
    }

    public function dateInformation(): HasOne
    {
        return $this->hasOne(ClaimDateInformation::class);
    }

    public function patientInformation(): HasOne
    {
        return $this->hasOne(PatientAdditionalInformation::class);
    }

    public function status(): MorphToMany
    {
        return $this->morphedByMany(ClaimStatus::class, 'claim_status', 'claim_status_claims');
    }

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    public function subStatus(): MorphToMany
    {
        return $this->morphedByMany(ClaimSubStatus::class, 'claim_status', 'claim_status_claims');
    }

    public function setDemographicInformation(DemographicInformationWrapper $demographicInformationData): void
    {
        /** @var ClaimDemographicInformation */
        $demographicInformation = $this
            ->demographicInformation()
            ->updateOrCreate(
                ['claim_id' => $this->id],
                $demographicInformationData->getData()
            );

        $demographicInformation->healthProfessionals()->sync($demographicInformationData->getHealthProfessionals());
    }

    public function setServices(ClaimServicesWrapper $services): void
    {
        /** @var ClaimServices */
        $claimService = $this
            ->services()
            ->updateOrCreate(
                ['claim_id' => $this->id],
                $services->getData()
            );

        Services::upsert($services->getService()->getData(), ['id']);

        $claimService->diagnoses()->sync($services->getDiagnoses()->toArray());
        $claimService->services()->upsert($services
            ->getService()
            ->map(function (array $service) use ($claimService) {
                $service['claim_id'] = $claimService->id;

                return $service;
            })
            ->toArray(), ['id', 'claim_id']);
    }

    public function setInsurancePolicies(Collection $policiesInsurances): void
    {
        $this
            ->insurancePolicies()
            ->sync($policiesInsurances->toArray());
    }

    public function setStates(?string $status, ?int $subStatus): void
    {
        if (null !== $status) {
            $this->status()->sync(
                ClaimStatus::query()->where('status', $status)->first()->id
            );
        }

        if (null !== $subStatus) {
            $this->subStatus()->sync(
                ClaimSubStatus::query()->where('id', $subStatus)->first()->id
            );
        }
    }

    public function setAditionalInformation(AditionalInformationWrapper $aditionalInformation): void
    {
        $this->dateInformation()
            ->updateOrCreate(
                ['claim_id' => $this->id],
                $aditionalInformation->getDateInformation()
            );
        $this->patientInformation()
            ->updateOrCreate(
                ['claim_id' => $this->id],
                $aditionalInformation->getPatientInformation()
            );
    }
}
