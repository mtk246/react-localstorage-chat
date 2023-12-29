<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\StatusClaimMedical.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimStatusMedical|null $claimStatusMedical
 *
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusClaimMedical query()
 *
 * @mixin \Eloquent
 */
class StatusClaimMedical extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'status_category_code',
        'status_category_code_value',
        'status_code',
        'status_code_value',
        'entity_code',
        'entity',
        'effective_date',
        'submitted_amount',
        'amount_paid',
        'paid_date',
        'check_issue_date',
        'check_number',
        'tracking_number',
        'claim_service_date',
        'trading_partner_claim_number',
        'claim_status_medical_id',
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
