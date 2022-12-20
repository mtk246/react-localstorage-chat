<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Claim extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "qr_claim",
        "control_number",
        "submitter_name",
        "submitter_contact",
        "submitter_phone",
        "company_id",
        "facility_id",
        "patient_id",
        "health_professional_id",
        "insurance_company_id",
        "validate",
        "claim_formattable_type",
        "claim_formattable_id"
    ];

    protected $with = ["claimFormattable"];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'format', 'last_modified', 'private_note', 'status', 'status_history',
        'billed_amount', 'amount_paid', 'past_due_date', 'date_of_service', 'status_date'
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
     * Claim belongs to InsuranceCompany.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class);
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
     * Claim has many ClaimService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimServices()
    {
        return $this->hasMany(ClaimService::class);
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
        return $this->belongsToMany(Diagnosis::class, 'claim_diagnosis', 'claim_id', 'diagnosis_id')->withPivot('item')->withTimestamps();
    }

    /**
     * The insurance policies that belong to the Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePolicies()
    {
        return $this->belongsToMany(InsurancePolicy::class, 'claim_insurance_policy', 'claim_id', 'insurance_policy_id')->withTimestamps();
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
     * Interact with the claim's format.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getFormatAttribute()
    {
        return $this->claimFormattable->type_form_id ?? '';
    }

    /**
     * Interact with the claim's privateNote.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getPrivateNoteAttribute()
    {
        return $this->claimStatusClaims()
                    ->orderBy("created_at", "desc")
                    ->orderBy("id", "asc")->first()->privateNotes->note ?? '';
    }

    /**
     * Interact with the claim's status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getStatusAttribute()
    {
        return $this->claimStatusClaims()
                    ->orderBy("created_at", "desc")
                    ->orderBy("id", "asc")->first()->claimStatus->status ?? 'Draft';
    }

    /**
     * Interact with the claim's status history.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getStatusHistoryAttribute()
    {
        $records = [];
        $history = $this->claimStatusClaims()
                        ->orderBy("created_at", "desc")
                        ->orderBy("id", "asc")->get() ?? [];
        foreach ($history as $status) {
            $record = [];
            $record['note']   = $status->privateNotes->note ?? '';
            $record['status'] = $status->claimStatus->status;
            $record['status_date'] = $status->created_at;
            $record['last_modified'] = $status->last_modified ?? '';
            array_push($records, $record);
        }
        return $records;
    }

    public function getLastModifiedAttribute()
    {
        $record = [
            'user'  => '',
            'roles' => [],
        ];
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return [
                'user'  => 'Console',
                'roles' => [],
            ];
        } else {
            $user = User::with(['profile', 'roles'])->find($lastModified->user_id);
            return [
                'user'  => $user->profile->first_name . ' ' . $user->profile->last_name,
                'roles' => $user->roles,
            ];
        }
    }

    public function getBilledAmountAttribute()
    {
        return '0.00';
    }

    public function getAmountPaidAttribute()
    {
        return '0.00';
    }

    public function getPastDueDateAttribute()
    {
        $date = '';
        $claimForm = $this->claimFormattable;
        if ($this->claim_formattable_type == ClaimFormP::class) {
            foreach ($claimForm->claimFormServices  ?? [] as $service) {
                if ($date == '') {
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
        if ($this->claim_formattable_type == ClaimFormP::class) {
            foreach ($claimForm->claimFormServices ?? [] as $service) {
                if ($date == '') {
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
        $status = $this->claimStatusClaims()->orderBy("created_at", "desc")->orderBy("id", "asc")->first();
        return (isset($status)) ? $status->created_at : '';
    }

    public function scopeSearch($query, $search)
    {
        return $query;
    }
}
