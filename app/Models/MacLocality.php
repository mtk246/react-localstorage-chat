<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\MacLocality
 *
 * @property int $id
 * @property string $mac
 * @property string $state
 * @property string $fsa
 * @property string $counties
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $locality_number
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read Attribute $modifier
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property-read int|null $procedure_fees_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property-read int|null $procedures_count
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality query()
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereCounties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereFsa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereLocalityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereMac($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MacLocality whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @mixin \Eloquent
 */
class MacLocality extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "mac",
        "locality_number",
        "state",
        "fsa",
        "counties"
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['modifier'];

    /**
     * The procedures that belong to the MacLocality. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function procedures()
    {
        return $this->belongsToMany(Procedure::class)->withPivot('modifier_id')->withTimestamps();
    }

    /**
     * MacLocality has many ProcedureFees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function procedureFees()
    {
        return $this->hasMany(ProcedureFee::class);
    }

    /**
     * Interact with the macLocality's state.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function state(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    /**
     * Interact with the macLocality's fsa.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function fsa(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    /**
     * Interact with the macLocality's counties.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function counties(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    /**
     * Interact with the macLocality's modifier.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getModifierAttribute()
    {
        return Modifier::find($this->pivot->modifier_id ?? null);
    }

}
