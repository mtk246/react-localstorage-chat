<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimServiceLine.
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Claim $claim
 * @property \App\Models\PlaceOfService|null $placeOfService
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimServiceLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimServiceLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimServiceLine query()
 *
 * @mixin \Eloquent
 */
class ClaimServiceLine extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'assigned_number',
        'service_date',
        'provider_control_number',
        'procedure_identifier',
        'procedure_code',
        'procedure_modifiers',
        'description',
        'line_item_charge_amount',
        'measurement_unit',
        'service_unit_count',
        'diagnosis_code_pointers',
        'claim_id',
        'place_of_service_id',
    ];

    /**
     * ClaimServiceLine belongs to Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * ClaimServiceLine belongs to PlaceOfService.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function placeOfService()
    {
        return $this->belongsTo(PlaceOfService::class);
    }
}
