<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimFormIRevenue.
 *
 * @property int $id
 * @property string $code
 * @property string $description
 * @property string $hcpcs
 * @property string $service_date
 * @property string $service_units
 * @property string $total_charges
 * @property string $non_covered_charges
 * @property int $claim_form_i_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\ClaimFormI $claimFormI
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereClaimFormIId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereHcpcs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereNonCoveredCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereServiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereServiceUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereTotalCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIRevenue whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 *
 * @mixin \Eloquent
 */
class ClaimFormIRevenue extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'code',
        'description',
        'hcpcs',
        'service_date',
        'service_units',
        'total_charges',
        'non_covered_charges',
        'claim_form_i_id',
    ];

    /**
     * ClaimFormI belongs to ClaimFormIRevenue.
     */
    public function claimFormI(): BelongsTo
    {
        return $this->belongsTo(ClaimFormI::class);
    }
}
