<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

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
