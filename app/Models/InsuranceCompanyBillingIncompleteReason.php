<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\InsuranceCompanyBillingIncompleteReason.
 *
 * @property int $id
 * @property int $billing_incomplete_reason_id
 * @property int $insurance_company_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereBillingIncompleteReasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyBillingIncompleteReason whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class InsuranceCompanyBillingIncompleteReason extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        'insurance_company_id',
        'billing_incomplete_reason_id',
        'billing_company_id',
    ];
}
