<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\Enum\ColorTypeCast;
use App\Casts\Procedure\ClasificationsCast;
use App\Enums\Procedure\ProcedureType;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Procedure.
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $start_date
 * @property string|null $end_date
 * @property |null $type
 * @property |null $clasifications
 * @property string|null $short_description
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyService> $companyServices
 * @property int|null $company_services_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Copay> $copays
 * @property int|null $copays_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Diagnosis> $diagnoses
 * @property int|null $diagnoses_count
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsuranceCompany> $insuranceCompanies
 * @property int|null $insurance_companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property int|null $insurance_plans_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\MacLocality> $macLocalities
 * @property int|null $mac_localities_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Modifier> $modifiers
 * @property int|null $modifiers_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureConsideration> $procedureCosiderations
 * @property int|null $procedure_cosiderations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property int|null $procedure_fees_count
 * @property \App\Models\PublicNote|null $publicNote
 *
 * @method static \Database\Factories\ProcedureFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure query()
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereClasifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Procedure whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Procedure extends Model implements Auditable
{
    use Searchable;
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'code',
        'start_date',
        'end_date',
        'short_description',
        'description',
        'type',
        'clasifications',
        'active',
    ];

    /** @var string[] */
    protected $hidden = [
        'pivot',
    ];

    /** @var array<key, string> */
    protected $casts = [
        'type' => ColorTypeCast::class.':'.ProcedureType::class,
        'clasifications' => ClasificationsCast::class,
        'active' => 'boolean',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companyServices()
    {
        return $this->hasMany(CompanyService::class);
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

    public function scopeSearch($query, $search)
    {
        if ('' != $search) {
            return $query->whereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")])
                ->orWhereRaw('LOWER(description) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }

    public function copays(): BelongsToMany
    {
        return $this->belongsToMany(Copay::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'code' => $this->code,
            'public_note' => $this->publicNote?->note,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'type' => $this->type->value,
            'clasification.general' => $this->clasifications['general']?->resource->getName(),
            'clasification.specific' => $this->clasifications['specific']?->resource->getName(),
            'clasification.sub_specific' => $this->clasifications['sub_specific']?->resource->getName(),
        ];
    }
}
