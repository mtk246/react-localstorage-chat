<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\InsurancePolicy;
use App\Models\PrivateNote;
use App\Models\RefileReason;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\DenialRefile.
 *
 * @property int $id
 * @property int $refile_type
 * @property string|null $policy_id
 * @property bool|null $is_cross_over
 * @property string|null $cross_over_date
 * @property string $note
 * @property string|null $original_claim_id
 * @property int|null $refile_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $claim_id
 * @property int|null $private_note_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Claims\Claim $claim
 * @property InsurancePolicy|null $insurancePolicy
 * @property PrivateNote|null $privateNotes
 * @property RefileReason|null $refileReason
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile query()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereCrossOverDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereIsCrossOver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereOriginalClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile wherePolicyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile wherePrivateNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereRefileReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereRefileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialRefile whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class DenialRefile extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;
    use Searchable;

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
        return $this->belongsTo(Claim::class, 'claim_id');
    }

    public function toSearchableArray()
    {
        return [
            'refile_type' => $this->refile_type,
            'policy_id' => $this->policy_id,
            'is_cross_over' => $this->is_cross_over,
            'cross_over_date' => $this->cross_over_date,
            'note' => $this->note,
            'original_claim_id' => $this->original_claim_id,
            'refile_reason' => $this->refile_reason,
            'claim_id' => $this->claim_id,
            'private_note_id' => $this->private_note_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'claim.code' => $this->claim->code,
            'claim.status' => $this->claim->status->last()?->status,
            'claim.sub_status' => $this->claim->subStatus->last()?->status,
        ];
    }
}
