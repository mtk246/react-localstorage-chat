<?php

declare(strict_types=1);

namespace App\Models\v2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * ClaimServices has many Service.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
