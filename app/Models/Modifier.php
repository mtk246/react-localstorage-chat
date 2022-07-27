<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

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
}
