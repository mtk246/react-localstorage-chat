<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\Diagnosis;
use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimService.
 *
 * @property int $id
 * @property int $claim_id
 * @property string|null $diagnosis_related_group_id
 * @property string|null $non_covered_charges
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $from
 * @property string|null $to
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Claims\Claim $claim
 * @property \Illuminate\Database\Eloquent\Collection<int, Diagnosis> $diagnoses
 * @property int|null $diagnoses_count
 * @property TypeCatalog|null $diagnosisRelatedGroup
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\Services> $services
 * @property int|null $services_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimService query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimService whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimService whereDiagnosisRelatedGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimService whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimService whereNonCoveredCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimService whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimService whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ClaimService extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'claim_id',
        'from',
        'to',
        'diagnosis_related_group_id',
        'non_covered_charges',
    ];

    /**
     * Claim belongs to Claim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    /**
     * PhysicianOrSupplierInformation belongs to DiagnosisRelatedGroup.
     */
    public function diagnosisRelatedGroup()
    {
        return $this->belongsTo(TypeCatalog::class, 'diagnosis_related_group_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Services::class);
    }

    public function diagnoses(): BelongsToMany
    {
        return $this->belongsToMany(Diagnosis::class, 'claim_diagnosis', 'claim_service_id', 'diagnosis_id')->withPivot(['item', 'poa', 'admission'])->withTimestamps();
    }
}
