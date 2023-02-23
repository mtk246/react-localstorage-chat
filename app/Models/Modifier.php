<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\Modifier
 *
 * @property int $id
 * @property string $modifier
 * @property string $special_coding_instructions
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $start_date
 * @property string|null $end_date
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read mixed $last_modified
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read int|null $modifier_considerations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierInvalidCombination> $modifierInvalidCombinations
 * @property-read int|null $modifier_invalid_combinations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read int|null $procedures_count
 * @property-read \App\Models\PublicNote|null $publicNote
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereModifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereSpecialCodingInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modifier whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierConsideration> $modifierConsiderations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModifierInvalidCombination> $modifierInvalidCombinations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @mixin \Eloquent
 */
class Modifier extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "modifier",
        "start_date",
        "end_date",
        "special_coding_instructions",
        "active"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

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
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
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
            return $query->whereRaw('LOWER(modifier) LIKE (?)', [strtolower("%$search%")])
                         ->orWhereRaw('LOWER(special_coding_instructions) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }
}
