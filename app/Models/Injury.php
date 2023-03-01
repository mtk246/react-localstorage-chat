<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\Injury
 *
 * @property int $id
 * @property string $diag_date
 * @property int $diagnosis_id
 * @property int|null $type_diag_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Diagnosis $diagnosis
 * @property-read \App\Models\PublicNote $publicNote
 * @property-read \App\Models\TypeDiag|null $typeDiag
 * @method static \Illuminate\Database\Eloquent\Builder|Injury newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Injury newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Injury query()
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereDiagDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereDiagnosisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereTypeDiagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Injury whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class Injury extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "diag_date",
        "diagnosis_id",
        "type_diag_id"
    ];

    /**
     * Injury belongs to Diagnosis.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }

    /**
     * Injury belongs to TypeDiag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeDiag()
    {
        return $this->belongsTo(TypeDiag::class);
    }

    /**
     * Injury morphs many publicNotes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function publicNote()
    {
        return $this->morphOne(PublicNote::class, 'publishable');
    }
}
