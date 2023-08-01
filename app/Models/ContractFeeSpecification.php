<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ContractFeeSpecification.
 *
 * @property int $id
 * @property string $code
 * @property int $contract_fee_id
 * @property int $billing_provider_id
 * @property int $billing_provider_taxonomy_id
 * @property int $health_professional_id
 * @property int $health_professional_taxonomy_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\HealthProfessional $billingProvider
 * @property \App\Models\Taxonomy $billingProviderTaxonomy
 * @property \App\Models\ContractFee $contractFee
 * @property \App\Models\HealthProfessional $healthProfessional
 * @property \App\Models\Taxonomy $healthProfessionalTaxonomy
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification whereBillingProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification whereBillingProviderTaxonomyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification whereContractFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification whereHealthProfessionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification whereHealthProfessionalTaxonomyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractFeeSpecification whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class ContractFeeSpecification extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    /** @var string[] */
    protected $fillable = [
        'code',
        'contract_fee_id',
        'billing_provider_id',
        'billing_provider_tax_id',
        'billing_provider_taxonomy_id',
        'health_professional_id',
        'health_professional_tax_id',
        'health_professional_taxonomy_id',
    ];

    /**
     * Get the contractFee that owns the ContractFeeSpecification.
     */
    public function contractFee(): BelongsTo
    {
        return $this->belongsTo(ContractFee::class);
    }

    /**
     * Get the billingProvider that owns the ContractFeeSpecification.
     */
    public function billingProvider(): BelongsTo
    {
        return $this->belongsTo(HealthProfessional::class);
    }

    /**
     * Get the billingProviderTaxonomy that owns the ContractFeeSpecification.
     */
    public function billingProviderTaxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }

    /**
     * Get the healthProfessional that owns the ContractFeeSpecification.
     */
    public function healthProfessional(): BelongsTo
    {
        return $this->belongsTo(HealthProfessional::class);
    }

    /**
     * Get the healthProfessionalTaxonomy that owns the ContractFeeSpecification.
     */
    public function healthProfessionalTaxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }
}
