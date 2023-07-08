<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\PrivateNote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimCheckStatus.
 *
 * @property int $id
 * @property string|null $response_details
 * @property string|null $interface_type
 * @property string|null $interface
 * @property string|null $consultation_date
 * @property string|null $resolution_time
 * @property string|null $past_due_date
 * @property int $private_note_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereConsultationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereInterface($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereInterfaceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus wherePastDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus wherePrivateNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereResolutionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereResponseDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimCheckStatus whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property PrivateNote $privateNote
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 *
 * @mixin \Eloquent
 */
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
