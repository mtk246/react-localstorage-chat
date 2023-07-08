<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Enums\Claim\RuleFormatType;
use App\Models\BillingCompany;
use App\Models\InsuranceCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Claims\Rules.
 *
 * @property int $id
 * @property string $name
 * @property RuleFormatType $format
 * @property string $description
 * @property int|null $billing_company_id
 * @property array $rules
 * @property array|null $parameters
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $insurance_company_id
 * @property BillingCompany|null $billingCompany
 * @property \Illuminate\Database\Eloquent\Collection<int, InsuranceCompany> $insuranceCompanies
 * @property int|null $insurance_companies_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Rules newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rules newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rules query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereParameters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, InsuranceCompany> $insuranceCompanies
 *
 * @mixin \Eloquent
 */
final class Rules extends Model
{
    use HasFactory;

    protected $table = 'claim_rules';

    protected $fillable = [
        'name',
        'format',
        'description',
        'billing_company_id',
        'insurance_company_id',
        'rules',
        'parameters',
    ];

    protected $casts = [
        'format' => RuleFormatType::class,
        'rules' => 'array',
        'parameters' => 'array',
    ];

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    public function insuranceCompany(): BelongsTo
    {
        return $this->belongsTo(InsuranceCompany::class);
    }
}
