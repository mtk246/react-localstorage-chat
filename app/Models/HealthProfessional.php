<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\MultipleRecordsFoundException;
use Illuminate\Support\Collection;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\HealthProfessional.
 *
 * @property int $id
 * @property string $npi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $code
 * @property bool $is_provider
 * @property string|null $npi_company
 * @property int|null $company_id
 * @property string|null $nppes_verified_at
 * @property string|null $ein
 * @property string|null $upin
 * @property int|null $profile_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillingCompany> $billingCompanies
 * @property int|null $billing_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property int|null $companies_count
 * @property \App\Models\Company|null $company
 * @property Collection $companies_providers
 * @property mixed $last_modified
 * @property mixed $status
 * @property \App\Models\User|null $user
 * @property mixed $verified_on_nppes
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\HealthProfessionalType> $healthProfessionalType
 * @property int|null $health_professional_type_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\PrivateNote> $privateNotes
 * @property int|null $private_notes_count
 * @property \App\Models\Profile|null $profile
 * @property \App\Models\PublicNote|null $publicNote
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Taxonomy> $taxonomies
 * @property int|null $taxonomies_count
 *
 * @method static \Database\Factories\HealthProfessionalFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional query()
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereEin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereIsProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereNpi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereNpiCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereNppesVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HealthProfessional whereUpin($value)
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
        'profile_id',
        'company_id',
        'health_professional_type_id',
        'nppes_verified_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['user', 'status', 'last_modified', 'companies_providers', 'verified_on_nppes'];

    /**
     * Patient belongs to user.
     */
    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Profile::class, 'id', 'profile_id', 'profile_id', 'id');
    }

    public function profile(): BelongsTo
    {
        return $this->BelongsTo(Profile::class);
    }

    public function getUserAttribute(): ?User
    {
        $results = $this->user()->get();

        if (($count = $results->count()) > 1) {
            throw new MultipleRecordsFoundException($count);
        }

        return $results->first();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /** private data
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
        return $this->belongsToMany(Taxonomy::class)->withTimestamps()->withPivot('billing_company_id', 'primary');
    }

    /**
     * The billingCompanies that belong to the HealthProfessional.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function billingCompanies()
    {
        return $this->belongsToMany(BillingCompany::class)
            ->using(BillingCompanyHealthProfessional::class)
            ->withPivot(['id', 'status', 'npi_company', 'is_provider', 'company_id', 'health_professional_type_id', 'miscellaneous'])
            ->withTimestamps();
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
            $user = User::find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles()?->get(['name'])->pluck('name'),
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

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'npi' => $this->npi,
            'name' => $this->profile?->fullName(),
            'profile.first_name' => $this->profile?->first_name,
            'profile.middle_name' => $this->profile?->middle_name,
            'profile.last_name' => $this->profile?->last_name,
            'profiles.date_of_birth' => $this->profile?->date_of_birth,
            'user.email' => $this->user->email ?? null,
            'user.ssn' => $this->profile->ssn,
            'company.name' => $this->company?->name,
            'company.npi' => $this->company?->npi,
            'company.code' => $this->company?->code,
            'billingCompanies.id' => $this->billingCompanies->pluck('id'),
            'billingCompanies.name' => $this->billingCompanies->pluck('name'),
        ];
    }
}
