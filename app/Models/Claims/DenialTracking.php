<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\InsurancePolicy;
use App\Models\PrivateNote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\DenialTracking.
 *
 * @property int $id
 * @property int $interface_type
 * @property bool $is_reprocess_claim
 * @property bool $is_contact_to_patient
 * @property string|null $contact_through
 * @property string|null $claim_number
 * @property string|null $rep_name
 * @property string|null $ref_number
 * @property int $claim_status
 * @property int|null $claim_sub_status
 * @property string $tracking_date
 * @property string|null $resolution_time
 * @property string|null $past_due_date
 * @property string $follow_up
 * @property string|null $department_responsible
 * @property string $policy_responsible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property object|null $response_details
 * @property int $claim_id
 * @property int $private_note_id
 * @property int|null $policy_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Claims\Claim $claim
 * @property \App\Models\Claims\ClaimStatus|null $claimStatus
 * @property \App\Models\Claims\ClaimSubStatus|null $claimSubStatus
 * @property InsurancePolicy|null $insurancePolicy
 * @property PrivateNote $privateNote
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking query()
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereClaimNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereClaimStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereClaimSubStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereContactThrough($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereDepartmentResponsible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereFollowUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereInterfaceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereIsContactToPatient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereIsReprocessClaim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking wherePastDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking wherePolicyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking wherePolicyResponsible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking wherePrivateNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereRefNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereRepName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereResolutionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereResponseDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereTrackingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DenialTracking whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class DenialTracking extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;
    use Searchable;

    protected $table = 'denial_tracking';

    protected $fillable = [
        'interface_type',
        'is_reprocess_claim',
        'is_contact_to_patient',
        'contact_through',
        'claim_number',
        'rep_name',
        'ref_number',
        'claim_status',
        'claim_sub_status',
        'tracking_date',
        'resolution_time',
        'past_due_date',
        'follow_up',
        'department_responsible',
        'policy_responsible',
        'response_details',
        'private_note_id',
        'claim_id',
        'policy_id',
    ];

    protected $casts = [
        'response_details' => 'object',
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
     * Get the related claimStatus for this denial tracking entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimStatus()
    {
        return $this->belongsTo(ClaimStatus::class, 'claim_status');
    }

    /**
     * Get the related claimSubstatus for this denial tracking entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimSubStatus()
    {
        return $this->belongsTo(ClaimSubStatus::class, 'claim_sub_status');
    }

    /**
     * Get the related claimSubstatus for this denial tracking entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function privateNote()
    {
        return $this->belongsTo(PrivateNote::class);
    }

    /**
     * Create a new denial tracking entry.
     *
     * @return static|null
     */
    public static function createDenialTracking(array $data)
    {
        $denial = DenialTracking::create($data);

        return $denial;
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

    public function insurancePolicy(): BelongsTo
    {
        return $this->belongsTo(InsurancePolicy::class, 'policy_id');
    }

    public function toSearchableArray()
    {
        return [
            'interface_type' => $this->interface_type,
            'is_reprocess_claim' => $this->is_reprocess_claim,
            'is_contact_to_patient' => $this->is_contact_to_patient,
            'contact_through' => $this->contact_through,
            'claim_number' => $this->claim_number,
            'rep_name' => $this->rep_name,
            'ref_number' => $this->ref_number,
            'claim_status' => $this->claim_status,
            'claim_sub_status' => $this->claim_sub_status,
            'tracking_date' => $this->tracking_date,
            'resolution_time' => $this->resolution_time,
            'past_due_date' => $this->past_due_date,
            'follow_up' => $this->follow_up,
            'department_responsible' => $this->department_responsible,
            'policy_responsible' => $this->policy_responsible,
            'response_details' => $this->response_details,
            'private_note_id' => $this->private_note_id,
            'claim_id' => $this->claim_id,
            'policy_id' => $this->policy_id,
        ];
    }
}
