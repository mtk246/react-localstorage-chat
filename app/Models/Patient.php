<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\Patient
 *
 * @property int $id
 * @property string $marital_status
 * @property string $driver_licence
 * @property bool $dependent
 * @property string $guardian_name
 * @property string $guardian_phone
 * @property string $spuse_name
 * @property string $employer
 * @property string $employer_address
 * @property string $position
 * @property string $phone_employer
 * @property string $spuse_employer
 * @property string $spuse_work_phone
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EmergencyContact[] $emergencyContacts
 * @property-read int|null $emergency_contacts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InsurancePlan[] $insurancePlans
 * @property-read int|null $insurance_plans_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDependent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDriverLicence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereEmployer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereEmployerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereGuardianName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereGuardianPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePhoneEmployer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereSpuseEmployer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereSpuseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereSpuseWorkPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUserId($value)
 * @mixin \Eloquent
 */
class Patient extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "driver_license",
        "credit_score",
        "user_id",
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status', 'last_modified'];

    /**
     * The billingCompanies that belong to the patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function billingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
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

    /**
     * Patient belongs to user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Patient has one Marital.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function marital()
    {
        return $this->hasOne(Marital::class);
    }

    /**
     * Patient has one Guarantor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function guarantor()
    {
        return $this->hasOne(Guarantor::class);
    }

    /**
     * Patient has one PatientConditionRelated
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patientConditionRelated()
    {
        return $this->hasOne(PatientConditionRelated::class);
    }

    /**
     * Patient has many ClaimInformation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimInformations()
    {
        return $this->hasMany(ClaimInformation::class);
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emergencyContacts(): HasMany
    {
        return $this->hasMany(EmergencyContact::class);
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
        return $this->belongsToMany(Company::class)->withTimestamps();
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
     * The insurancePlans that belong to the Patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePolicies()
    {
        return $this->belongsToMany(InsurancePolicy::class)->withPivot('own_insurance')->withTimestamps();
    }

    /*
     * Get the patient's status.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute()
    {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return false;
        return $this->billingCompanies->find($billingCompany->id)->pivot->status ?? false;
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

    public function scopeSearch($query, $search)
    {
        if ($search != "") {
            return $query->whereHas('user', function ($q) use ($search) {
                            $q->whereHas('profile', function ($qq) use ($search) {
                                $qq->whereRaw('LOWER(first_name) LIKE (?)', [strtolower("%$search%")])
                                  ->orWhereRaw('LOWER(last_name) LIKE (?)', [strtolower("%$search%")])
                                  ->orWhereRaw('LOWER(ssn) LIKE (?)', [strtolower("%$search%")]);
                            })->orWhereHas('billingCompanies', function ($qqq) use ($search) {
                                $qqq->orWhereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")]);
                            })->orWhereRaw('LOWER(email) LIKE (?)', [strtolower("%$search%")]);
                        });
        }

        return $query;
    }
}
