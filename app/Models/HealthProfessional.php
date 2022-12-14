<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class HealthProfessional extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "npi",
        "npi_company",
        "is_provider",
        "user_id",
        "company_id",
        "health_professional_type_id"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified', 'companies_providers'];

    /**
     * HealthProfessional belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * HealthProfessional belongs to HealthProfessionalType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function healthProfessionalType()
    {
        return $this->belongsTo(HealthProfessionalType::class);
    }

    /**
     * The companies that belong to the heatProfessional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class)->using(CompanyHealthProfessional::class)->withPivot('authorization', 'billing_company_id')->withTimestamps();
    }

    /**
     * The taxonomies that belong to the heatProfessional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taxonomies()
    {
        return $this->belongsToMany(Taxonomy::class)->withTimestamps();
    }

    /**
     * The billingCompanies that belong to the HealthProfessional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function billingCompanies()
    {
        return $this->belongsToMany(BillingCompany::class)->withPivot('status')->withTimestamps();
    }

    /**
     * HealthProfessional morphs one publicNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
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

    public function getCompaniesProvidersAttribute()
    {
        $records = [];
        foreach ($this->companies ?? [] as $key => $company) {
            array_push($records, $company->pivot);
        }
        return $records;
    }

    public function scopeSearch($query, $search)
    {
        if ($search != "") {
            return $query->whereHas('user', function ($q) use ($search) {
                            $q->whereHas('profile', function ($qq) use ($search) {
                                $qq->whereRaw('LOWER(first_name) LIKE (?)', [strtolower("%$search%")])
                                  ->orWhereRaw('LOWER(last_name) LIKE (?)', [strtolower("%$search%")])
                                  ->orWhereRaw('LOWER(ssn) LIKE (?)', [strtolower("%$search%")]);
                            })->orWhereRaw('LOWER(email) LIKE (?)', [strtolower("%$search%")]);
                        })->orWhereRaw('LOWER(npi) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }
}
