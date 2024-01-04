<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\Diagnosis\ClasificationsCast;
use App\Enums\Diagnoses\DiagnosesType;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Diagnosis.
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $start_date
 * @property string|null $end_date
 * @property bool $injury_date_required
 * @property DiagnosesType|null $type
 * @property |null $clasifications
 * @property string|null $description_long
 * @property string|null $age
 * @property string|null $age_end
 * @property int|null $gender_id
 * @property bool $status
 * @property int|null $discriminatory_id
 * @property bool $protected
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Discriminatory|null $discriminatory
 * @property \App\Models\Gender|null $gender
 * @property mixed $created_by
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 * @property \App\Models\PublicNote|null $publicNote
 *
 * @method static Builder|Diagnosis newModelQuery()
 * @method static Builder|Diagnosis newQuery()
 * @method static Builder|Diagnosis query()
 * @method static Builder|Diagnosis search($search)
 * @method static Builder|Diagnosis whereActive($value)
 * @method static Builder|Diagnosis whereAge($value)
 * @method static Builder|Diagnosis whereAgeEnd($value)
 * @method static Builder|Diagnosis whereClasifications($value)
 * @method static Builder|Diagnosis whereCode($value)
 * @method static Builder|Diagnosis whereCreatedAt($value)
 * @method static Builder|Diagnosis whereDescription($value)
 * @method static Builder|Diagnosis whereDescriptionLong($value)
 * @method static Builder|Diagnosis whereDiscriminatoryId($value)
 * @method static Builder|Diagnosis whereEndDate($value)
 * @method static Builder|Diagnosis whereGenderId($value)
 * @method static Builder|Diagnosis whereId($value)
 * @method static Builder|Diagnosis whereInjuryDateRequired($value)
 * @method static Builder|Diagnosis whereProtected($value)
 * @method static Builder|Diagnosis whereStartDate($value)
 * @method static Builder|Diagnosis whereStatus($value)
 * @method static Builder|Diagnosis whereType($value)
 * @method static Builder|Diagnosis whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Diagnosis extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    protected $table = 'diagnoses';

    protected $fillable = [
        'code',
        'start_date',
        'end_date',
        'description',
        'active',
        'injury_date_required',
        'type',
        'clasifications',
        'description_long',
        'age',
        'age_end',
        'gender_id',
        'status',
        'discriminatory_id',
        'protected',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified', 'created_by'];

    protected $casts = [
        'type' => DiagnosesType::class,
        'clasifications' => ClasificationsCast::class,
    ];

    /**
     * Diagnosis morphs many publicNotes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function publicNote()
    {
        return $this->morphOne(PublicNote::class, 'publishable');
    }

    /**
     * The procedures that belong to the Diagnosis.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function procedures()
    {
        return $this->belongsToMany(Procedure::class, 'diagnosis_procedure', 'diagnosis_id', 'procedure_id')->withTimestamps();
    }

    /**
     * The Diagnosis that belong to the Gender.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    /**
     * The Diagnosis that belong to the Gender.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discriminatory()
    {
        return $this->belongsTo(Discriminatory::class, 'discriminatory_id');
    }

    /**
     * Interact with the diagnosis's description.
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

    public function getCreatedByAttribute()
    {
        $createdBy = $this->audits()->first();
        if (!isset($createdBy->user_id)) {
            return 'Console';
        } else {
            $user = User::query()
                ->find($createdBy->user_id);

            return $user->profile->first_name.' '.$user->profile->last_name;
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

    public function toSearchableArray(): array
    {
        return [
            'code' => $this->code,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
            'public_note' => $this->publicNote?->note,
        ];
    }

    protected static function booted(): void
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', true);
        });
    }
}
