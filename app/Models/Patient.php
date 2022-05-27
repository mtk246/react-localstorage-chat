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
        "driver_license",
        "credit_score",
        "user_id",
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['insurance_policies'];

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
     * Patient belongs to Suscribers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function suscribers()
    {
        return $this->belongsToMany(Suscriber::class)->withTimestamps();
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
        return $this->belongsToMany(InsurancePlan::class)->withPivot('status', 'own_insurance')->withTimestamps();
    }

    /*
     * Get the insurance policies patient.
     *
     * @return array
     */
    public function getInsurancePoliciesAttribute()
    {
        $insurancePolicies = [];
        foreach ($this->insurancePlans as $insurancePlan) {
            array_push($insurancePolicies, [
                'insurance_company_id' => $insurancePlan['insurance_company_id'],
                'insurance_plan_id'    => $insurancePlan['id'],
                'own'                  => $insurancePlan['pivot']['own_insurance'],
                'suscriber'            => $insurancePlan['suscribers']['0'] ?? null
            ]);
            
        }
        return $insurancePolicies;
    }
}
