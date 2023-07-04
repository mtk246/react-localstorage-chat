<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\Diagnosis\ClasificationsCast;
use app\Enums\Diagnoses\DiagnosesType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Builder;

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
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 * @property \App\Models\PublicNote $publicNote
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis query()
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereInjuryDateRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Diagnosis whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
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
        'status'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

    protected $casts = [
        'clasifications' => ClasificationsCast::class,
    ];

    protected function type(): Attribute
    {
        return Attribute::make(
            set: fn (int $value) => DiagnosesType::tryFrom($value),
        );
    }

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
            $user = User::with(['profile', 'roles'])->find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles,
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
