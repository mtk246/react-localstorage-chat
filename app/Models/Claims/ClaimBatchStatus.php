<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

final class ClaimBatchStatus extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'status', 'background_color', 'font_color',
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
