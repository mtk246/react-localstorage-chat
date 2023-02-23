<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\InsuranceCompanyAppealReason
 *
 * @property int $id
 * @property int $appeal_reason_id
 * @property int $insurance_company_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereAppealReasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereInsuranceCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InsuranceCompanyAppealReason whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InsuranceCompanyAppealReason extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        "insurance_company_id",
        "appeal_reason_id",
        "billing_company_id"
    ];
}
