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
use App\Models\PrivateNote;
use App\Models\User;
use App\Traits\Claim\ClaimFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property \App\Models\Claims\ClaimService|null $services
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimStatus> $status
 * @property int|null $status_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimSubStatus> $subStatus
 * @property int|null $sub_status_count
 *
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
 *
 * @property string|null $code
 * @property int|null $billing_company_id
 * @property ClaimType $type
 * @property mixed $aditional_information
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimDateInformation> $dateInformations
 * @property int|null $date_informations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, InsurancePolicy> $insurancePolicies
 * @property \App\Models\Claims\ClaimService|null $service
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimStatus> $status
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimSubStatus> $subStatus
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereAditionalInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereType($value)ClaimServices
 *
 * @mixin \Eloquent
 */
class Claim extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;
    use ClaimFile;

    protected $fillable = [
        'code',
        'type',
        'submitter_name',
        'submitter_contact',
        'submitter_phone',
        'billing_company_id',
        'aditional_information',
    ];

    protected $casts = [
        'type' => ClaimType::class,
        'format' => FormatType::class,
    ];

    protected $appends = [
        'last_modified', 'private_note', 'billed_amount', 'amount_paid',
        'past_due_date', 'date_of_service', 'status_date', 'user_created',
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

    public function service(): HasOne
    {
        return $this->hasOne(ClaimService::class);
    }

    public function dateInformations(): HasMany
    {
        return $this->hasMany(ClaimDateInformation::class);
    }

    public function patientInformation(): HasOne
    {
        return $this->hasOne(PatientAdditionalInformation::class);
    }

    public function claimStatusClaims(): HasMany
    {
        return $this->hasMany(ClaimStatusClaim::class);
    }

    public function status(): MorphToMany
    {
        return $this->morphedByMany(ClaimStatus::class, 'claim_status', 'claim_status_claim');
    }

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    public function subStatus(): MorphToMany
    {
        return $this->morphedByMany(ClaimSubStatus::class, 'claim_status', 'claim_status_claim');
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            return $query
                ->where('code', 'LIKE', strtoupper("%$search%"))
                ->orWhere(function ($query) use ($search) {
                    $this->searchByUserProfile($query, $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $this->searchByCompany($query, $search);
                })
                ->orWhere(function ($query) use ($search) {
                    $this->searchByClaimFormServices($query, $search);
                })
                ->orWhereHas('insurancePolicies', function ($q) use ($search) {
                    $q->where('order', 1)->whereHas('typeResponsibility', function ($qq) use ($search) {
                        $qq->where('code', 'LIKE', strtoupper("%$search%"));
                    });
                })
                ->orWhere(function ($query) use ($search) {
                    $query->with('service.services')
                        ->when(is_numeric($search), function ($query, $search) {
                            $this->searchByClaimFormServicesTotalPrice($query, $search);
                        });
                });
        });
    }

    protected function searchByUserProfile($query, $search)
    {
        $query->with(['demographicInformation.patient.user.profile'])
            ->whereHas('demographicInformation.patient.user.profile', function ($q) use ($search) {
                $q->whereRaw('LOWER(first_name) LIKE ?', [strtolower("%$search%")])
                    ->orWhereRaw('LOWER(last_name) LIKE ?', [strtolower("%$search%")])
                    ->orWhereRaw('LOWER(ssn) LIKE ?', [strtolower("%$search%")]);
            });
    }

    protected function searchByCompany($query, $search)
    {
        $query->with(['demographicInformation.company'])
            ->orWhereHas('demographicInformation.company', function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', [strtolower("%$search%")]);
            });
    }

    protected function searchByClaimFormServices($query, $search)
    {
        $query->with('service.services')
            ->whereHas('service.services', function ($subQuery) use ($search) {
                $subQuery->when($search, function ($query, $search) {
                    $query->where(function ($query) {
                        $query->orderBy('from_service', 'asc')
                            ->orderBy('to_service', 'desc')
                            ->limit(1);
                    })
                    ->where('from_service', 'LIKE', "%$search%")
                    ->orWhere('to_service', 'LIKE', "%$search%");
                });
            })
            ->limit(1);
    }

    protected function searchByClaimFormServicesTotalPrice($query, $search)
    {
        $query->whereHas('service', function ($q) use ($search) {
            $q->whereHas('services', function ($subQuery) use ($search) {
                $subQuery->selectRaw('SUM(CAST(price AS DECIMAL(10,2))) as total_price')
                    ->groupBy('services.id')
                    ->havingRaw('SUM(CAST(price AS DECIMAL(10,2))) = ?', [(float) $search]);
            });
        });
    }

    public function getLastModifiedAttribute()
    {
        $record = [
            'user' => '',
            'roles' => [],
        ];
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return [
                'user' => 'Console',
                'roles' => [],
            ];
        } else {
            $user = User::with(['profile', 'roles'])->find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles,
            ];
        }
    }

    /**
     * Interact with the claim's privateNote.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getPrivateNoteAttribute()
    {
        $status = $this->claimStatusClaims()
                    ->orderBy('created_at', 'desc')
                    ->orderBy('id', 'desc')->first();
        if (isset($status)) {
            $note = $status->privateNotes()->orderBy('created_at', 'desc')
                           ->orderBy('id', 'asc')->first();
        }

        return (isset($note)) ? $note : null;
    }

    public function getBilledAmountAttribute()
    {
        $billed = array_reduce($this->service?->services?->toArray() ?? [], function ($carry, $service) {
            return $carry + ((float) $service['price'] ?? 0);
        }, 0);

        return number_format($billed, 2);
    }

    public function getAmountPaidAttribute()
    {
        $billed = array_reduce($this->service?->services?->toArray() ?? [], function ($carry, $service) {
            return $carry + ((float) $service['price'] ?? 0);
        }, 0);

        return number_format($billed, 2);
    }

    public function getPastDueDateAttribute()
    {
        /** @todo Esta fecha viene del insurance company Tyme Filing */
        $services = $this->service?->services ?? collect([]);

        return $services->max('to_service') ?? '';
    }

    public function getDateOfServiceAttribute()
    {
        $services = $this->service?->services ?? collect([]);

        return $services->min('from_service') ?? '';
    }

    public function getStatusDateAttribute()
    {
        $status = $this->claimStatusClaims()
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->first();

        return (isset($status)) ? $status->created_at?->format('Y-m-d') : '';
    }

    public function getUserCreatedAttribute()
    {
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return 'Console';
        } else {
            $user = User::with(['profile', 'roles'])->find($lastModified->user_id);

            return $user->profile->first_name.' '.$user->profile->last_name;
        }
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

        $healthProfessionals = $demographicInformationData->getHealthProfessionals();
        $data = [];
        foreach ($healthProfessionals as $pivot) {
            $data[$pivot['health_professional_id']] = [
                'claim_id' => $demographicInformation['claim_id'],
                'health_professional_id' => $pivot['health_professional_id'],
                'field_id' => $pivot['field_id'],
                'qualifier_id' => $pivot['qualifier_id'],
            ];
        }

        $demographicInformation->healthProfessionals()->sync($data);
    }

    public function setServices(ClaimServicesWrapper $services): void
    {
        /** @var ClaimService */
        $claimService = $this
            ->service()
            ->updateOrCreate(
                ['claim_id' => $this->id],
                $services->getData()
            );

        $claimService->diagnoses()->sync($services->getDiagnoses()->toArray());
        $claimService->services()->upsert($services
            ->getService()
            ->map(function (array $service) use ($claimService) {
                $service['claim_service_id'] = $claimService->id;

                return $service;
            })
            ->toArray(), ['id']);
    }

    public function setInsurancePolicies(Collection $insurancePolicies): void
    {
        $this
            ->insurancePolicies()
            ->sync($insurancePolicies->toArray());
    }

    public function setStates(?int $status, ?int $subStatus, ?string $note): void
    {
        if (null !== $status) {
            $claimStatusClaim = ClaimStatusClaim::create([
                'claim_id' => $this->id,
                'claim_status_type' => ClaimStatus::class,
                'claim_status_id' => $status,
            ]);
        }

        if (null !== $subStatus) {
            $claimStatusClaim = ClaimStatusClaim::create([
                'claim_id' => $this->id,
                'claim_status_type' => ClaimSubStatus::class,
                'claim_status_id' => $subStatus,
            ]);
        }

        if (null !== $note) {
            PrivateNote::create([
                'publishable_type' => ClaimStatusClaim::class,
                'publishable_id' => $claimStatusClaim->id,
                'billing_company_id' => $this->billing_company_id,
                'note' => $note,
            ]);
        }
    }

    public function setAdditionalInformation(AditionalInformationWrapper $aditionalInformation): void
    {
        foreach ($aditionalInformation->getDateInformation() as $data) {
            $this->dateInformations()
            ->updateOrCreate(
                ['claim_id' => $this->id],
                $data
            );
        }
        if (ClaimType::INSTITUTIONAL->value == $this->type) {
            $this->patientInformation()
                ->updateOrCreate(
                    ['claim_id' => $this->id],
                    $aditionalInformation->getPatientInformation()
                );
        }
    }
}
