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
 * @property string|null $code
 * @property string|null $submitter_name
 * @property string|null $submitter_contact
 * @property string|null $submitter_phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $billing_company_id
 * @property ClaimType $type
 * @property mixed $aditional_information
 * @property FormatType $format
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property BillingCompany|null $billingCompany
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimBatch> $claimBatchs
 * @property int|null $claim_batchs_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimStatusClaim> $claimStatusClaims
 * @property int|null $claim_status_claims_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimTransmissionResponse> $claimTransmissionResponses
 * @property int|null $claim_transmission_responses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimDateInformation> $dateInformations
 * @property int|null $date_informations_count
 * @property \App\Models\Claims\ClaimDemographicInformation|null $demographicInformation
 * @property mixed $amount_paid
 * @property mixed $billed_amount
 * @property mixed $date_of_service
 * @property mixed $last_modified
 * @property mixed $past_due_date
 * @property \Illuminate\Database\Eloquent\Casts\Attribute $private_note
 * @property mixed $status_date
 * @property mixed $user_created
 * @property \Illuminate\Database\Eloquent\Collection<int, InsurancePolicy> $insurancePolicies
 * @property int|null $insurance_policies_count
 * @property \App\Models\Claims\PatientAdditionalInformation|null $patientInformation
 * @property \App\Models\Claims\ClaimService|null $service
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimStatus> $status
 * @property int|null $status_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimSubStatus> $subStatus
 * @property int|null $sub_status_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereAditionalInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereSubmitterContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereSubmitterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereSubmitterPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereUpdatedAt($value)
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

    public function denialTrackings()
    {
        return $this->hasMany(DenialTracking::class, 'claim_id');
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

    public function claimTransmissionResponses()
    {
        return $this->hasMany(ClaimTransmissionResponse::class);
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

    public function claimBatchs()
    {
        return $this->belongsToMany(ClaimBatch::class)->withTimestamps();
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
        $query->with(['demographicInformation.patient.profile'])
            ->whereHas('demographicInformation.patient.profile', function ($q) use ($search) {
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
                    ->havingRaw('SUM(CAST(price AS DECIMAL(10,2))) = ?', [number_format((float) $search, 2)]);
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
            $user = User::find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles()?->get(['name'])->pluck('name'),
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
        $billed = $this->service->services->reduce(function ($carry, $service) {
            return $carry + ($service['days_or_units'] ?? 1) * ((float) $service['price'] ?? 0);
        }, 0);

        return number_format($billed, 2);
    }

    public function getAmountPaidAttribute()
    {
        $paid = $this->service->services->reduce(function ($carry, $service) {
            return $carry + ((float) $service['copay'] ?? 0);
        }, 0);

        return number_format($paid, 2);
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
            $user = User::find($lastModified->user_id);

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

        $demographicInformation->healthProfessionals()->detach();
        $demographicInformation->healthProfessionals()->sync($demographicInformationData->getHealthProfessionals());
    }

    public function setServices(
        ClaimServicesWrapper $services,
        AditionalInformationWrapper $aditionals
    ): void {
        /** @var ClaimService */
        $claimService = $this
            ->service()
            ->updateOrCreate(
                ['claim_id' => $this->id],
                $aditionals->getData()
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

    public function setStates(int $status, ?int $subStatus, ?string $note): void
    {
        $defaultNote = '';
        $statusNew = ClaimStatus::find($status);
        $subStatusNew = ClaimSubStatus::find($subStatus);
        $currentType = $this->claimStatusClaims()
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ?->first()
            ?->claim_status_type ?? null;

        $statusCurrent = $this->claimStatusClaims()
            ->where('claim_status_type', ClaimStatus::class)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->first() ?? null;
        $subStatusCurrent = $this->claimStatusClaims()
            ->where('claim_status_type', ClaimSubStatus::class)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->first() ?? null;

        if (ClaimStatus::class == $currentType) {
            $defaultNote = 'Status change successful, from '.$statusCurrent->claimStatus->status.' to '.$statusNew->status.(($subStatusNew) ? (' - '.$subStatusNew->status) : '');
        } elseif (ClaimSubStatus::class == $currentType) {
            $defaultNote = 'Substatus change successful, from '.$statusCurrent->claimStatus->status.' - '.$subStatusCurrent->claimStatus->name.' to '.$statusNew->status.(($subStatusNew) ? (' - '.$subStatusNew->name) : '');
        }
        if ($status !== $statusCurrent?->claim_status_id) {
            $claimStatus = ClaimStatusClaim::create([
                'claim_id' => $this->id,
                'claim_status_type' => ClaimStatus::class,
                'claim_status_id' => $status,
            ]);
        }
        if (null === $subStatus) {
            PrivateNote::create([
                'publishable_type' => ClaimStatusClaim::class,
                'publishable_id' => $claimStatus?->id ?? $statusCurrent->id,
                'billing_company_id' => $this->billing_company_id,
                'note' => $note ?? $defaultNote,
            ]);
        } else {
            $claimSubStatus = ClaimStatusClaim::create([
                'claim_id' => $this->id,
                'claim_status_type' => ClaimSubStatus::class,
                'claim_status_id' => $subStatus,
            ]);
            PrivateNote::create([
                'publishable_type' => ClaimStatusClaim::class,
                'publishable_id' => $claimSubStatus?->id ?? $subStatusCurrent->id,
                'billing_company_id' => $this->billing_company_id,
                'note' => $note ?? $defaultNote,
            ]);
        }
    }

    public function setAdditionalInformation(AditionalInformationWrapper $aditionalInformation): void
    {
        $arrayIds = array_column(array_filter($aditionalInformation->getDateInformation(), function ($objeto) {
            return isset($objeto['id']);
        }), 'id');

        $this->dateInformations()
            ->whereNotIn('claim_date_informations.id', $arrayIds)
            ->get()
            ->each(function (ClaimDateInformation $dateInfo) {
                $dateInfo->delete();
            });

        foreach ($aditionalInformation->getDateInformation() as $data) {
            $this->dateInformations()
            ->updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                    'claim_id' => $this->id,
                ],
                $data
            );
        }
        if (ClaimType::INSTITUTIONAL == $this->type) {
            $this->patientInformation()
                ->updateOrCreate(
                    ['claim_id' => $this->id],
                    $aditionalInformation->getPatientInformation()
                );
        }
    }

    public function setPrivateNote(string $note): void
    {
        $statusCurrent = $this->claimStatusClaims()
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->first() ?? null;

        PrivateNote::create([
            'publishable_type' => ClaimStatusClaim::class,
            'publishable_id' => $statusCurrent->id,
            'billing_company_id' => $this->billing_company_id,
            'note' => $note,
        ]);
    }

    public function getDenialTrackings()
    {
        return $this->hasMany(DenialTracking::class, 'claim_id')->get();
    }
}
