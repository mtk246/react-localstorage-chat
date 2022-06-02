<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ModifierInvalidCombination extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "modifier_id",
        "invalid_combination"
    ];

    /**
     * ModifierInvalidCombination belongs to Modifier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modifier()
    {
        return $this->belongsTo(Modifier::class);
    }
}
