<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * DenialTracking model.
 *
 * @property int $id
 * @property int $interface_type
 * @property bool $is_reprocess_claim
 * @property bool $is_contact_to_patient
 * @property string $contact_through
 * @property string $rep_name
 * @property string $ref_number
 * @property string $status_claim
 * @property string $sub_status_claim
 * @property string $tracking_date
 * @property string $past_due_date
 * @property string $follow_up
 * @property string $department_responsible
 * @property string $policy_responsible
 * @property string $tracking_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $claim_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking query()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereContactThrough($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereDepartmentResponsible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereFollowUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereInterfaceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereIsContactToPatient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereIsReprocessClaim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking wherePastDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking wherePolicyResponsible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereRefNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereRepName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereStatusClaim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereSubStatusClaim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereTrackingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereTrackingNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class DenialTracking extends Model
{
    use HasFactory;

    protected $table = 'denial_tracking';

    protected $fillable = [
        'interface_type',
        'is_reprocess_claim',
        'is_contact_to_patient',
        'contact_through',
        'claim_id',
        'rep_name',
        'ref_number',
        'status_claim',
        'sub_status_claim',
        'tracking_date',
        'past_due_date',
        'follow_up',
        'department_responsible',
        'policy_responsible',
        'tracking_note',
    ];

    /**
     * Get the related claim for this denial tracking entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * Create a new denial tracking entry.
     *
     * @return static|null
     */
    public static function createDenialTracking(array $data)
    {
        try {
            $denial = DenialTracking::create($data);

            return $denial;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Update a denial tracking entry by ID.
     *
     * @return static|null
     */
    public static function updateDenialTracking(array $data)
    {
        $denialId = $data['denial_id'];

        $denial = DenialTracking::where('id', $denialId)->first();

        if ($denial) {
            $denial->update($data);

            return $denial;
        }

        return null;
    }
}
