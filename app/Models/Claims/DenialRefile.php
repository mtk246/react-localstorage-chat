<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\InsurancePolicy;
use App\Models\PrivateNote;
use App\Models\RefileReason;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\DenialRefile.
 *
 * @property int $id
 * @property int $refile_type
 * @property string $policy_number
 * @property bool $is_cross_over
 * @property string $cross_over_date
 * @property string $note
 * @property string|null $original_claim_id
 * @property int|null $refile_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $denial_tracking_id
 * @property int $claim_id
 * @property RefileReason|null $refileReason
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile query()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereCrossOverDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereDenialTrackingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereIsCrossOver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereOriginalClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile wherePolicyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereRefileReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereRefileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property InsurancePolicy|null $insurancePolicy
 * @property PrivateNote $privateNotes
 * @property Claim $claim
 *
 * @mixin \Eloquent
 */
final class DenialRefile extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'denial_refile';

    protected $fillable = [
        'refile_type',
        'policy_id',
        'is_cross_over',
        'cross_over_date',
        'note',
        'original_claim_id',
        'refile_reason',
        'claim_id',
        'private_note_id',
    ];

    public function refileReason(): BelongsTo
    {
        return $this->belongsTo(RefileReason::class, 'refile_reason');
    }

    public function insurancePolicy(): BelongsTo
    {
        return $this->belongsTo(InsurancePolicy::class, 'policy_id');
    }

    public function privateNotes(): BelongsTo
    {
        return $this->belongsTo(PrivateNote::class, 'private_note_id');
    }

    public function claim(): BelongsTo
    {
        return $this->belongsTo(claim::class, 'claim_id');
    }
}
