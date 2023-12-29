<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\MacLocality.
 *
 * @property int $id
 * @property string $mac
 * @property string $state
 * @property string $fsa
 * @property string $counties
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $locality_number
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property Attribute $modifier
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProcedureFee> $procedureFees
 * @property int|null $procedure_fees_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 *
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
 *
 * @mixin \Eloquent
 */
class MacLocality extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'mac',
        'locality_number',
        'state',
        'fsa',
        'counties',
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
