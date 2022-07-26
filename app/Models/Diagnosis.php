<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Diagnosis extends Model implements Auditable
{
    use HasFactory, AuditableTrait;
    
    protected $table = 'diagnoses';
    
    protected $fillable = [
        "code",
        "start_date",
        "end_date",
        "description",
        "active"
    ];

    /**
     * Diagnosis morphs many publicNotes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
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

}
