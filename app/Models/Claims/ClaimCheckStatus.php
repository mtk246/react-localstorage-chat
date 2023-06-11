<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

final class ClaimCheckStatus extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    protected $fillable = [
        'response_details',
        'interface_type',
        'interface',
        'consultation_date',
        'resolution_time',
        'past_due_date',
        'private_note_id',
    ];

    /**
     * Get the privateNote that owns the ClaimCheckStatus.
     */
    public function privateNote(): BelongsTo
    {
        return $this->belongsTo(PrivateNote::class);
    }
}
