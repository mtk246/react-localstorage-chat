<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

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
     * Get the privateNote that owns the ClaimCheckStatus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function privateNote(): BelongsTo
    {
        return $this->belongsTo(PrivateNote::class);
    }
}
