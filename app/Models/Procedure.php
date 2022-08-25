<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Procedure extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "start_date",
        "end_date",
        "description",
        "active",
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

    /**
     * Procedure has many ProcedureFees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureFees()
    {
        return $this->hasMany(ProcedureFee::class);
    }

    /**
     * Procedure has many ProcedureCosiderations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureCosiderations()
    {
        return $this->hasMany(ProcedureConsideration::class);
    }

    /**
     * The companies that belong to the Procedure. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    /**
     * The diagnoses that belong to the Procedure. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function diagnoses()
    {
        return $this->belongsToMany(Diagnosis::class, 'diagnosis_procedure', 'procedure_id', 'diagnoses_id')->withTimestamps();
    }

    /**
     * The modifiers that belong to the Procedure. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modifiers()
    {
        return $this->belongsToMany(Modifier::class)->withTimestamps();
    }

    /**
     * The mac localities that belong to the Procedure. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function macLocalities()
    {
        return $this->belongsToMany(MacLocality::class)->withPivot('modifier_id')->withTimestamps();
    }

    /**
     * The insuranceCompany that belong to the Procedure. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insuranceCompanies()
    {
        return $this->belongsToMany(InsuranceCompany::class)->withTimestamps();
    }

    /**
     * The insurancePlan that belong to the Procedure. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insurancePlans()
    {
        return $this->belongsToMany(InsurancePlan::class)->withPivot('price', 'price_percentage')->withTimestamps();
    }

    /**
     * Procedure morphs one publicNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function publicNote()
    {
        return $this->morphOne(PublicNote::class, 'publishable');
    }

    /**
     * Interact with the procedure's description.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst(strtolower($value)),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }

    public function getLastModifiedAttribute()
    {
        $record = [
            'user'  => '',
            'roles' => [],
        ];
        $lastModified = $this->audits()->latest()->first();
        if ($lastModified->user_id == '') {
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
}
