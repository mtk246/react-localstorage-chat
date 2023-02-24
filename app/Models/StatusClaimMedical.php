<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\StatusClaimMedical
 *
 * @property int $id
 * @property string $status_category_code
 * @property string $status_category_code_value
 * @property string $status_code
 * @property string $status_code_value
 * @property string $entity_code
 * @property string $entity
 * @property string $effective_date
 * @property float $submitted_amount
 * @property float $amount_paid
 * @property string $paid_date
 * @property string $check_issue_date
 * @property string $check_number
 * @property string $tracking_number
 * @property string $claim_service_date
 * @property string $trading_partner_claim_number
 * @property int $claim_status_medical_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimStatusMedical $claimStatusMedical
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical query()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereAmountPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereCheckIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereCheckNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereClaimServiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereClaimStatusMedicalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereEffectiveDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereEntityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical wherePaidDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereStatusCategoryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereStatusCategoryCodeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereStatusCodeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereSubmittedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereTrackingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereTradingPartnerClaimNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class StatusClaimMedical extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "status_category_code",
        "status_category_code_value",
        "status_code",
        "status_code_value",
        "entity_code",
        "entity",
        "effective_date",
        "submitted_amount",
        "amount_paid",
        "paid_date",
        "check_issue_date",
        "check_number",
        "tracking_number",
        "claim_service_date",
        "trading_partner_claim_number",
        "claim_status_medical_id",
    ];

    /**
     * StatusClaimMedical belongs to ClaimStatusMedical.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimStatusMedical()
    {
        return $this->belongsTo(ClaimStatusMedical::class);
    }
}
