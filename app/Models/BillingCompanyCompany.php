<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\BillingCompanyCompany.
 *
 * @property int $id
 * @property bool $status
 * @property int $billing_company_id
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $miscellaneous
 * @property array|null $claim_format_ids
 * @property bool $split_company_claim
 * @property \App\Models\BillingCompany $billingCompany
 * @property \App\Models\Company $company
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany whereClaimFormatIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany whereMiscellaneous($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany whereSplitCompanyClaim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillingCompanyCompany whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class BillingCompanyCompany extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        'company_id',
        'billing_company_id',
        'status',
        'miscellaneous',
        'claim_format_ids',
        'split_company_claim',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'claim_format_ids' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class, 'billing_company_id');
    }
}
