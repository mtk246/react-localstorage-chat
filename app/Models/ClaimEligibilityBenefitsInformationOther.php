<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimEligibilityBenefitsInformationOther.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimEligibility|null $claimEligibility
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimEligibilityBenefitsInformationOther query()
 *
 * @mixin \Eloquent
 */
class ClaimEligibilityBenefitsInformationOther extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'claim_eligibility_id',
        'code',
        'name',
        'service_type_codes',
        'service_types',
        'insurance_type_code',
        'insurance_type',
        'header_loop_identifier_code',
        'trailer_loop_identifier_code',
        'plan_number',
        'plan_network_id_number',
        'benefits_date_information',
        'entity_identifier',
        'entity_type',
        'entity_name',
        'address',
        'city',
        'state',
        'postal_code',
        'communication_mode',
        'communication_number',
    ];

    /**
     * ClaimEligibilityBenefitsInformationOther belongs to ClaimEligibility.
     */
    public function claimEligibility(): BelongsTo
    {
        return $this->belongsTo(ClaimEligibility::class);
    }
}
