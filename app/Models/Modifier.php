<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Modifier\ClassificationType;
use App\Enums\Modifier\ModifierType;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Modifier.
 *
 * @property int $id
 * @property string $modifier
 * @property string|null $special_coding_instructions
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $start_date
 * @property string|null $end_date
 * @property ClassificationType $classification
 * @property ModifierType $type
 * @property string $description
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property int|null $modifier_considerations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierInvalidCombination> $modifierInvalidCombinations
 * @property int|null $modifier_invalid_combinations_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 * @property \App\Models\PublicNote|null $publicNote
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereClassification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereModifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereSpecialCodingInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Modifier extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    protected $fillable = [
        'modifier',
        'start_date',
        'end_date',
        'special_coding_instructions',
        'classification',
        'type',
        'description',
        'active',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

    /** @var array<key, string> */
    protected $casts = [
        'classification' => ClassificationType::class,
        'type' => ModifierType::class,
    ];

    /**
     * Modifier has many ModifierInvalidCombinations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modifierInvalidCombinations()
    {
        return $this->hasMany(ModifierInvalidCombination::class);
    }

    /**
     * Modifier has many ModifierConsiderations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modifierConsiderations()
    {
        return $this->hasMany(ModifierConsideration::class);
    }

    /**
     * The procedures that belong to the Modifier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function procedures()
    {
        return $this->belongsToMany(Procedure::class)->withTimestamps();
    }

    /**
     * Modifier morphs one publicNote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function publicNote()
    {
        return $this->morphOne(PublicNote::class, 'publishable');
    }

    /**
     * Interact with the modifier's special_coding_instructions.
     */
    protected function specialCodingInstructions(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
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
            return $query->whereRaw('LOWER(modifier) LIKE (?)', [strtolower("%$search%")])
                ->orWhereRaw('LOWER(special_coding_instructions) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }

    public function toSearchableArray(): array
    {
        return [
            'modifier' => $this->modifier,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'special_coding_instructions' => $this->special_coding_instructions,
            'classification' => $this->classification,
            'type' => $this->type?->value,
            'description' => $this->description,
            'public_note' => $this->publicNote?->note,
        ];
    }

    /**
     * Set default value to upper string.
     */
    protected function modifier(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => strtoupper($value),
        );
    }

    /**
     * Interact with the Modifier description attribute.
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => upperCaseWords($value),
            set: fn ($value) => upperCaseWords($value),
        );
    }
}
