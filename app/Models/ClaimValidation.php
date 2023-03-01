<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimValidation
 *
 * @property int $id
 * @property string $control_number
 * @property array|null $response_details
 * @property int $claim_id
 * @property int $insurance_policy_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Claim $claim
 * @property-read \App\Models\InsurancePolicy $insurancePolicy
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereControlNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereInsurancePolicyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereResponseDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimValidation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ClaimValidation extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "control_number",
        "claim_id",
        "insurance_policy_id",
        "response_details",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'response_details' => 'array',
    ];

    /**
     * ClaimValidation belongs to Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * ClaimValidation belongs to InsurancePolicy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function insurancePolicy()
    {
        return $this->belongsTo(InsurancePolicy::class);
    }
}
