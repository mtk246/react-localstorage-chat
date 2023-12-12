<?php

declare(strict_types=1);

namespace App\Models\Claims;

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
 * @property string|null $cross_over_date
 * @property string $note
 * @property string|null $original_claim_id
 * @property int|null $refile_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $denial_tracking_id
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
 * @mixin \Eloquent
 */
final class DenialRefile extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'denial_refile';

    protected $fillable = [
        'refile_type',
        'policy_number',
        'is_cross_over',
        'cross_over_date',
        'note',
        'original_claim_id',
        'refile_reason',
        'denial_tracking_id',
        'claim_id',
    ];

    public function refileReason(): BelongsTo
    {
        return $this->belongsTo(RefileReason::class, 'refile_reason');
    }

    public static function createDenialRefile(array $data)
    {
        try {
            $denial = DenialRefile::create($data);

            return $denial;
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function updateDenialRefile(array $data)
    {
        $denialId = $data['refile_id'];

        $denial = DenialRefile::where('id', $denialId)->first();

        if ($denial) {
            $denial->update($data);

            return $denial;
        }

        return null;
    }
}
