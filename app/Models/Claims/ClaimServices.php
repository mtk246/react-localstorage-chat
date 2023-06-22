<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Models\Diagnosis;
use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Claims\ClaimServices.
 *
 * @property \App\Models\Claims\Claim $claim
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimServices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimServices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimServices query()
 *
 * @mixin \Eloquent
 */
final class ClaimServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_id',
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
        return $this->belongsToMany(Diagnosis::class, 'claim_diagnosis', 'claim_id', 'diagnosis_id')->withPivot(['item', 'poa', 'admission'])->withTimestamps();
    }
}
