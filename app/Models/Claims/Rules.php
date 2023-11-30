<?php

declare(strict_types=1);

namespace App\Models\Claims;

use App\Enums\Claim\RuleFormatType;
use App\Models\BillingCompany;
use App\Models\InsurancePlan;
use App\Models\TypeCatalog;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

/**
 * App\Models\Claims\Rules.
 *
 * @property string $id
 * @property string $name
 * @property RuleFormatType $format
 * @property string $description
 * @property int|null $billing_company_id
 * @property array $rules
 * @property array|null $parameters
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $insurance_plan_id
 * @property BillingCompany|null $billingCompany
 * @property InsurancePlan|null $insurancePlan
 * @property \Illuminate\Database\Eloquent\Collection<int, TypeCatalog> $typesOfResponsibilities
 * @property int|null $types_of_responsibilities_count
 *
 * @method static \Database\Factories\Claims\RulesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Rules newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rules newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rules query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereParameters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereRules($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rules whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Rules extends Model
{
    use HasFactory;
    use HasUlids;
    use Searchable;

    protected $table = 'claim_rules';

    protected $fillable = [
        'name',
        'format',
        'description',
        'billing_company_id',
        'insurance_plan_id',
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

    public function insurancePlan(): BelongsTo
    {
        return $this->belongsTo(InsurancePlan::class);
    }

    public function typesOfResponsibilities(): BelongsToMany
    {
        return $this->belongsToMany(TypeCatalog::class, 'claim_rule_type_responsibility', 'claim_rule_id', 'type_responsibility_id')->withTimestamps();
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'billing_company_id' => $this->billing_company_id,
            'billing_company' => $this->billingCompany->only(['code', 'name', 'abbreviation']),
            'insurance_plans' => $this->insurancePlan->only(['code', 'name', 'eff_date']),
        ];
    }
}
