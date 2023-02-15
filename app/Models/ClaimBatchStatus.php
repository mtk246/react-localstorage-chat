<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimBatchStatus extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "status", "background_color", "font_color"
    ];

    /**
     * ClaimBatchStatus has many ClaimBatches.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function claimBatches()
    {
        return $this->hasMany(ClaimBatch::class);
    }
}
