<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\HealthProfessional.
 *
 * @property int $id
 * @property string $npi
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property bool $is_provider
 * @property string|null $npi_company
 * @property int|null $health_professional_type_id
 * @property int|null $company_id
 * @property string|null $nppes_verified_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property int|null $companies_count
 * @property \App\Models\Company|null $company
 * @property \Illuminate\Support\collection $companies_providers
 * @property mixed $last_modified
 * @property mixed $status
 * @property mixed $verified_on_nppes
 * @property \App\Models\HealthProfessionalType|null $healthProfessionalType
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 * @property \App\Models\PublicNote|null $publicNote
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property int|null $taxonomies_count
 * @property \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional query()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereHealthProfessionalTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereIsProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereNpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereNpiCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereNppesVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereUserId($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 *
 * @mixin \Eloquent
 */
class HealthProfessional extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    protected $fillable = [
        'code',
        'npi',
        'ein',
        'upin',
        'npi_company',
        'is_provider',
        'user_id',
        'company_id',
        'health_professional_type_id',
        'nppes_verified_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['status', 'last_modified', 'companies_providers', 'verified_on_nppes'];

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
        return $this->hasMany(HealthProfessionalType::class);
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

    /*
     * Get the healthProfessional's status.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute()
    {
        $billingCompany = auth()->user()?->billingCompanies?->first();
        if (is_null($billingCompany)) {
            return false;
        }

        return $this->billingCompanies?->find($billingCompany->id)->pivot->status ?? false;
    }

    public function getVerifiedOnNppesAttribute()
    {
        return isset($this->nppes_verified_at) ? true : false;
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

    public function getCompaniesProvidersAttribute(): Collection
    {
        $records = [];
        foreach ($this->companies ?? [] as $key => $company) {
            array_push($records, $company->pivot);
        }

        return collect($this->companies)
            ->map(function ($company) {
                return $company->pivot;
            });
    }

    public function scopeSearch($query, $search)
    {
        if ('' != $search) {
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

    public function toSearchableArray()
    {
        return [
            'code' => $this->code,
            'npi' => $this->npi,
            'user.full_name' => $this->user->profile->first_name.' '.$this->user->profile->last_name,
            'user.first_name' => $this->user->profile->first_name,
            'user.last_name' => $this->user->profile->last_name,
            'user.email' => $this->user->email,
            'user.ssn' => $this->user->profile->ssn,
            'user.phone' => $this->user->profile->phone,
            'company.name' => $this->company?->name,
            'company.npi' => $this->company?->npi,
            'company.code' => $this->company?->code,
        ];
    }
}
