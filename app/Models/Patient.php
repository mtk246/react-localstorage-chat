<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Claims\Claim;
use App\Models\Claims\ClaimDemographicInformation;
use App\Models\Patient\Membership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\MultipleRecordsFoundException;
use Laravel\Scout\Searchable;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Patient.
 *
 * @property int $id
 * @property string|null $driver_license
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property int|null $marital_status_id
 * @property int|null $profile_id
 * @property int|null $main_address_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, ClaimDemographicInformation> $claimDemographics
 * @property int|null $claim_demographics_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property int|null $companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractFee> $contractFees
 * @property int|null $contract_fees_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\EmergencyContact> $emergencyContacts
 * @property int|null $emergency_contacts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employment> $employments
 * @property int|null $employments_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Encounter> $encounters
 * @property int|null $encounters_count
 * @property mixed $last_modified
 * @property mixed $status
 * @property \App\Models\User|null $user
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Guarantor> $guarantors
 * @property int|null $guarantors_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Injury> $injuries
 * @property int|null $injuries_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property int|null $insurance_plans_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * @property int|null $insurance_policies_count
 * @property \App\Models\Address|null $mainAddress
 * @property \App\Models\MaritalStatus|null $maritalStatus
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Marital> $maritals
 * @property int|null $maritals_count
 * @property \App\Models\PatientConditionRelated|null $patientConditionRelated
 * @property \App\Models\PatientPrivate|null $patientPrivate
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 * @property \App\Models\Profile|null $profile
 * @property \App\Models\PublicNote $publicNote
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscriber> $subscribers
 * @property int|null $subscribers_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDriverLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereMainAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereMaritalStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Patient extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    protected $fillable = [
        'code',
        'driver_license',
        'marital_status_id',
        'profile_id',
        'main_address_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['user', 'status', 'last_modified'];

    /**
     * Patient belongs to MaritalStatus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    /**
     * The billingCompanies that belong to the patient.
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)
            ->using(Membership::class)
            ->withPivot(['id', 'status', 'save_as_draft'])
            ->withTimestamps()
            ->as('membership');
    }

    public function mainAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'main_address_id');
    }

    /**
     * The injuries that belong to the Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function injuries()
    {
        return $this->belongsToMany(Injury::class, 'injury_patient', 'patient_id', 'injury_id')->withTimestamps();
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * Patient belongs to user.
     */
    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Profile::class, 'id', 'profile_id', 'profile_id', 'id');
    }

    public function getUserAttribute(): ?User
    {
        $results = $this->user()->get();

        if (($count = $results->count()) > 1) {
            throw new MultipleRecordsFoundException($count);
        }

        return $results->first();
    }

    /**
     * Patient has many Marital.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function maritals()
    {
        return $this->hasMany(Marital::class);
    }

    /**
     * Patient has one Guarantor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function guarantors()
    {
        return $this->hasMany(Guarantor::class);
    }

    /**
     * Patient has one PatientConditionRelated.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patientConditionRelated()
    {
        return $this->hasOne(PatientConditionRelated::class);
    }

    /**
     * Patient has many Encounter.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function encounters()
    {
        return $this->hasMany(Encounter::class);
    }

    /**
     * Patient has one Employment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employments()
    {
        return $this->hasMany(Employment::class);
    }

    /**
     * Patient has one PatientPrivate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patientPrivate()
    {
        return $this->hasOne(PatientPrivate::class);
    }

    /**
     * Patient has many emergencyContacts.
     */
    public function emergencyContacts(): HasMany
    {
        return $this->hasMany(EmergencyContact::class);
    }

    /**
     * Get all of the claims for the Patient.
     */
    public function claims()
    {
        return Claim::whereHas('demographicInformation', function ($query) {
            $query->where('patient_id', $this->id);
        });
    }

    /**
     * Patient morphs many publicNotes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function publicNote()
    {
        return $this->morphOne(PublicNote::class, 'publishable');
    }

    /**
     * Patient morphs many privateNotes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function privateNotes()
    {
        return $this->morphMany(PrivateNote::class, 'publishable');
    }

    /**
     * Patient belongs to Subscribers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class)->withTimestamps();
    }

    /**
     * The companies that belong to the patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class)->withPivot('billing_company_id', 'med_num')->withTimestamps();
    }

    /**
     * The insurancePlans that belong to the Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePlans()
    {
        return $this->belongsToMany(InsurancePlan::class)->withPivot('status')->withTimestamps();
    }

    /**
     * Get all of the insurancePolicies for the Patient.
     */
    public function insurancePolicies(): HasMany
    {
        return $this->hasMany(InsurancePolicy::class);
    }

    /*
     * Get all claimDemographics for the Patient.
     */
    public function claimDemographics(): HasMany
    {
        return $this->hasMany(ClaimDemographicInformation::class);
    }

    /*
     * Get the patient's status.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute()
    {
        $billingCompany = auth()->user()?->billingCompanies->first();
        if (is_null($billingCompany)) {
            return false;
        }

        return $this->billingCompanies->find($billingCompany->id)->pivot->status ?? false;
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

    public function contractFees(): BelongsToMany
    {
        return $this->belongsToMany(ContractFee::class)
            ->using(ContractFeePatient::class)
            ->withPivot('start_date', 'end_date')
            ->withTimestamps();
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->profile?->fullName(),
            'profile.first_name' => $this->profile?->first_name,
            'profile.middle_name' => $this->profile?->middle_name,
            'profile.last_name' => $this->profile?->last_name,
            'profile.date_of_birth' => $this->profile?->date_of_birth,
            'companies' => $this->companies->pluck('med_num'),
            'billingCompanies.id' => $this->billingCompanies->pluck('id'),
            'billingCompanies.name' => $this->billingCompanies->pluck('name'),
            'user.code' => $this->user?->usercode,
            'user.mail' => $this->user?->email,
        ];
    }
}
