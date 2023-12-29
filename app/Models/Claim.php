<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claim.
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $submitter_name
 * @property string|null $submitter_contact
 * @property string|null $submitter_phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $billing_company_id
 * @property string $type
 * @property mixed $aditional_information
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\HealthProfessional|null $billingProvider
 * @property Model|\Eloquent $claimFormattable
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimStatusClaim> $claimStatusClaims
 * @property int|null $claim_status_claims_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClaimTransmissionResponse> $claimTransmissionResponses
 * @property int|null $claim_transmission_responses_count
 * @property \App\Models\Company $company
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $diagnoses
 * @property int|null $diagnoses_count
 * @property \App\Models\Facility $facility
 * @property mixed $amount_paid
 * @property mixed $billed_amount
 * @property Attribute $billing_provider_name
 * @property mixed $date_of_service
 * @property Attribute $format
 * @property Attribute $insurance_company
 * @property Attribute $insurance_company_id
 * @property Attribute $insurance_plan
 * @property mixed $last_modified
 * @property mixed $notes_history
 * @property mixed $past_due_date
 * @property Attribute $private_note
 * @property Attribute $status
 * @property mixed $status_date
 * @property Attribute $status_history
 * @property Attribute $type_responsibility
 * @property Attribute $user_created
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessional> $healthProfessionals
 * @property int|null $health_professionals_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property int|null $insurance_policies_count
 * @property \App\Models\Patient|null $patient
 * @property \App\Models\HealthProfessional|null $referred
 * @property \App\Models\TypeCatalog|null $referredProviderRole
 * @property \App\Models\HealthProfessional|null $serviceProvider
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

    protected $fillable = [
        'qr_claim',
        'control_number',
        'submitter_name',
        'submitter_contact',
        'submitter_phone',
        'company_id',
        'facility_id',
        'patient_id',
        'billing_provider_id',
        'service_provider_id',
        'referred_id',
        'referred_provider_role_id',
        'validate',
        'automatic_eligibility',
        'claim_formattable_type',
        'claim_formattable_id',
    ];

    protected $with = ['claimFormattable'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'format', 'last_modified', 'private_note', 'status', 'status_history', 'notes_history',
        'billed_amount', 'amount_paid', 'past_due_date', 'date_of_service', 'status_date',
        'insurance_company_id', 'insurance_company', 'insurance_plan',
        'billing_provider_name', 'user_created', 'type_responsibility',
    ];

    /**
     * Claim belongs to Company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Claim belongs to Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Claim belongs to Facility.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    /**
     * Claim belongs to BillingProvider.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billingProvider()
    {
        return $this->belongsTo(HealthProfessional::class);
    }

    /**
     * Claim belongs to ServiceProvider.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceProvider()
    {
        return $this->belongsTo(HealthProfessional::class);
    }

    /**
     * Claim belongs to Referred.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referred()
    {
        return $this->belongsTo(HealthProfessional::class);
    }

    /**
     * Get the referredProviderRole that owns the Claim.
     */
    public function referredProviderRole(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'referred_provider_role_id');
    }

    /**
     * Claim morphs to models in claimFormattable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function claimFormattable()
    {
        return $this->morphTo();
    }

    /**
     * The diagnoses that belong to the Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function diagnoses()
    {
        return $this->belongsToMany(Diagnosis::class, 'claim_diagnosis', 'claim_id', 'diagnosis_id')->withPivot(['item', 'poa', 'admission'])->withTimestamps();
    }

    /**
     * The healthProfessionals that belong to the Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function healthProfessionals()
    {
        return $this->belongsToMany(HealthProfessional::class, 'claim_health_professional', 'claim_id', 'health_professional_id')->withPivot(['field_id', 'qualifier_id'])->withTimestamps();
    }

    /**
     * The insurance policies that belong to the Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePolicies()
    {
        return $this->belongsToMany(InsurancePolicy::class, 'claim_insurance_policy', 'claim_id', 'insurance_policy_id')->withPivot('order')->withTimestamps();
    }

    /**
     * The insurance policies that belong to the Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function claimStatusClaims()
    {
        return $this->hasMany(ClaimStatusClaim::class);
    }

    /**
     * Claim has many ClaimTransmissionResponses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimTransmissionResponses()
    {
        return $this->hasMany(ClaimTransmissionResponse::class);
    }

    /**
     * Interact with the claim's format.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getFormatAttribute()
    {
        return $this->claimFormattable->type_form_id ?? '';
    }

    /**
     * Interact with the claim's insuranceCompanyId.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getInsuranceCompanyIdAttribute()
    {
        $policyPrimary = $this->insurancePolicies()->first();

        return $policyPrimary->insurancePlan->insuranceCompany->id ?? '';
    }

    /**
     * Interact with the claim's insuranceCompanyId.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getInsuranceCompanyAttribute()
    {
        $policyPrimary = $this->insurancePolicies()->first();

        return $policyPrimary->insurancePlan->insuranceCompany->name ?? '';
    }

    /**
     * Interact with the claim's insurancePlan.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getInsurancePlanAttribute()
    {
        $policyPrimary = $this->insurancePolicies()->first();

        return $policyPrimary->insurancePlan->name ?? '';
    }

    /**
     * Interact with the claim's typeResponsibility.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getTypeResponsibilityAttribute()
    {
        $policyPrimary = $this->insurancePolicies()->first();

        return $policyPrimary->typeResponsibility->code ?? '';
    }

    /**
     * Interact with the claim's bilingProviderName.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getBillingProviderNameAttribute()
    {
        $billingProvider = $this->billingProvider->user->profile ?? null;

        return (isset($billingProvider)) ? ($billingProvider->first_name.' '.$billingProvider->last_name) : '';
    }

    /**
     * Interact with the claim's userCreated.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
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

    /**
     * Interact with the claim's status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getStatusAttribute()
    {
        $status = $this->claimStatusClaims()
                    ->where('claim_status_type', ClaimStatus::class)
                    ->orderBy('id', 'desc')->first() ?? null;
        $subStatus = $this->claimStatusClaims()
                          ->where('claim_status_type', ClaimSubStatus::class)
                          ->orderBy('id', 'desc')->first() ?? null;
        if (isset($status)) {
            $record = $status->claimStatus;
            $record['claim_sub_status'] = (isset($subStatus) && $subStatus->id > $status->id) ? $subStatus->claimStatus : null;
            $record['claim_sub_statuses'] = getList(ClaimSubStatus::class, 'name', ['relationship' => 'claimStatuses', 'where' => ['claim_status_id' => $record->id]]);
        }

        return $record ?? null;
    }

    public function getNotesHistoryAttribute()
    {
        $records = [];
        $recordSubstatus = [];
        $history = $this->claimStatusClaims()
                        ->orderBy('created_at', 'desc')
                        ->orderBy('id', 'desc')->get() ?? [];
        foreach ($history as $status) {
            if (ClaimSubStatus::class == $status->claim_status_type) {
                foreach ($status->privateNotes as $note) {
                    array_push(
                        $recordSubstatus,
                        [
                            'status' => $status->claimStatus->name ?? '',
                            'note' => $note->note,
                            'created_at' => $note->created_at,
                            'last_modified' => $note->last_modified,
                        ]
                    );
                }
            } elseif (ClaimStatus::class == $status->claim_status_type) {
                foreach ($recordSubstatus as $subNote) {
                    array_push(
                        $records,
                        [
                            'note' => $subNote['note'],
                            'created_at' => $subNote['created_at'],
                            'last_modified' => $subNote['last_modified'],
                            'check_status' => null,
                            'status' => $subNote['status'],
                            'status_background_color' => $status->claimStatus->background_color ?? '',
                            'status_font_color' => $status->claimStatus->font_color ?? '',
                        ]
                    );
                }
                $recordSubstatus = [];
                foreach ($status->privateNotes as $note) {
                    $check = ClaimCheckStatus::where('private_note_id', $note->id)->first();
                    array_push(
                        $records,
                        [
                            'note' => $note->note,
                            'created_at' => $note->created_at,
                            'last_modified' => $note->last_modified,
                            'check_status' => isset($check) ? [
                                'response_details' => $check->response_details ?? '',
                                'interface_type' => $check->interface_type ?? '',
                                'interface' => $check->interface ?? '',
                                'consultation_date' => $check->consultation_date ?? '',
                                'resolution_time' => $check->resolution_time ?? '',
                                'past_due_date' => $check->past_due_date ?? '',
                            ] : null,
                            'status' => $status->claimStatus->status ?? '',
                            'status_background_color' => $status->claimStatus->background_color ?? '',
                            'status_font_color' => $status->claimStatus->font_color ?? '',
                        ]
                    );
                }
            }
        }

        return $records;
    }

    /**
     * Interact with the claim's status history.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getStatusHistoryAttribute()
    {
        $records = [];
        $recordSubstatus = [];
        $history = $this->claimStatusClaims()
                        ->orderBy('created_at', 'desc')
                        ->orderBy('id', 'desc')->get() ?? [];
        foreach ($history as $status) {
            if (ClaimSubStatus::class == $status->claim_status_type) {
                $record = [];
                $notes = [];
                foreach ($status->privateNotes as $note) {
                    array_push(
                        $notes,
                        [
                            'note' => $note->note,
                            'created_at' => $note->created_at,
                            'last_modified' => $note->last_modified,
                        ]
                    );
                }
                $record['notes_history'] = $notes;
                $record['code'] = $status->claimStatus->code ?? '';
                $record['name'] = $status->claimStatus->name ?? '';
                $record['sub_status_date'] = $status->created_at;
                $record['last_modified'] = $status->last_modified ?? '';
                array_push($recordSubstatus, $record);
            } elseif (ClaimStatus::class == $status->claim_status_type) {
                $record = [];
                $notes = [];
                foreach ($status->privateNotes as $note) {
                    $check = ClaimCheckStatus::where('private_note_id', $note->id)->first();
                    array_push(
                        $notes,
                        [
                            'note' => $note->note,
                            'created_at' => $note->created_at,
                            'last_modified' => $note->last_modified,
                            'check_status' => isset($check) ? [
                                'response_details' => $check->response_details ?? '',
                                'interface_type' => $check->interface_type ?? '',
                                'interface' => $check->interface ?? '',
                                'consultation_date' => $check->consultation_date ?? '',
                                'resolution_time' => $check->resolution_time ?? '',
                                'past_due_date' => $check->past_due_date ?? '',
                            ] : null,
                        ]
                    );
                }
                $record['notes_history'] = $notes;
                $record['status'] = $status->claimStatus->status ?? '';
                $record['status_background_color'] = $status->claimStatus->background_color ?? '';
                $record['status_font_color'] = $status->claimStatus->font_color ?? '';
                $record['status_date'] = $status->created_at;
                $record['sub_status_history'] = $recordSubstatus;
                $record['last_modified'] = $status->last_modified ?? '';
                array_push($records, $record);
                $recordSubstatus = [];
            }
        }

        return $records;
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

    public function getBilledAmountAttribute()
    {
        $billed = 0;
        $claimForm = $this->claimFormattable;
        if (ClaimFormP::class == $this->claim_formattable_type) {
            foreach ($claimForm->claimFormServices ?? [] as $service) {
                $billed += ($service->price ?? 0);
            }
        }

        return number_format($billed, 2);
    }

    public function getAmountPaidAttribute()
    {
        return '0.00';
    }

    public function getPastDueDateAttribute()
    {
        /** @todo Esta fecha viene del insurance company Tyme Filing */
        $date = '';
        $claimForm = $this->claimFormattable;
        if (ClaimFormP::class == $this->claim_formattable_type) {
            foreach ($claimForm->claimFormServices ?? [] as $service) {
                if ('' == $date) {
                    $date = $service->to_service;
                } elseif ($service->to_service > $date) {
                    $date = $service->to_service;
                }
            }
        }

        return $date;
    }

    public function getDateOfServiceAttribute()
    {
        $date = '';
        $claimForm = $this->claimFormattable;
        if (ClaimFormP::class == $this->claim_formattable_type) {
            foreach ($claimForm->claimFormServices ?? [] as $service) {
                if ('' == $date) {
                    $date = $service->from_service;
                } elseif ($service->from_service < $date) {
                    $date = $service->from_service;
                }
            }
        }

        return $date;
    }

    public function getStatusDateAttribute()
    {
        $status = $this->claimStatusClaims()->orderBy('created_at', 'desc')->orderBy('id', 'desc')->first();

        return (isset($status)) ? $status->created_at->format('Y-m-d') : '';
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            return $query
                ->where('control_number', 'LIKE', "%$search%")
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
                    $query->with('claimFormattable.claimFormServices')
                        ->when(is_numeric($search), function ($query, $search) {
                            $this->searchByClaimFormServicesTotalPrice($query, $search);
                        });
                });
        });
    }

    protected function searchByUserProfile($query, $search)
    {
        $query->with(['patient.user.profile'])
            ->whereHas('patient.user.profile', function ($q) use ($search) {
                $q->whereRaw('LOWER(first_name) LIKE ?', [strtolower("%$search%")])
                    ->orWhereRaw('LOWER(last_name) LIKE ?', [strtolower("%$search%")])
                    ->orWhereRaw('LOWER(ssn) LIKE ?', [strtolower("%$search%")]);
            });
    }

    protected function searchByCompany($query, $search)
    {
        $query->with(['company'])
            ->orWhereHas('company', function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', [strtolower("%$search%")]);
            });
    }

    protected function searchByClaimFormServices($query, $search)
    {
        $query->with('claimFormattable.claimFormServices')
            ->whereHas('claimFormattable.claimFormServices', function ($subQuery) use ($search) {
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
        $query->whereHas('claimFormattable', function ($q) use ($search) {
            $q->whereHas('claimFormServices', function ($subQuery) use ($search) {
                $subQuery->selectRaw('SUM(price) as total_price')
                    ->groupBy('claim_form_p_services.id')
                    ->havingRaw('SUM(price) = ?', [$search]);
            });
        });
    }

    public function toSearchableArray()
    {
        $this->load(['company']);

        return [
            'control_number' => $this->control_number,
            'company.code' => $this->company?->code,
            'company.name' => $this->company?->name,
            'company.npi' => $this->company?->npi,
            'company.ein' => $this->company?->ein,
            'company.upin' => $this->company?->upin,
            'company.clia' => $this->company?->clia,
        ];
    }
}
