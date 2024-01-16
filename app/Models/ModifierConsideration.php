<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ModifierConsideration.
 *
 * @property int $id
 * @property int $modifier_id
 * @property int $gender_id
 * @property int $age_init
 * @property int $age_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $discriminatory_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Discriminatory $discriminatory
 * @property \App\Models\Gender $gender
 * @property \App\Models\Modifier $modifier
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereAgeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereAgeInit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereDiscriminatoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereModifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModifierConsideration whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ModifierConsideration extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'modifier_id',
        'gender_id',
        'age_init',
        'age_end',
        'discriminatory_id',
    ];

    /**
     * ModifierConsideration belongs to Modifier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modifier()
    {
        return $this->belongsTo(Modifier::class);
    }

    /**
     * ModifierConsideration belongs to Gender.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * ModifierConsideration belongs to Discriminatory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discriminatory()
    {
        return $this->belongsTo(Discriminatory::class);
    }
}
