<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class InsuranceCompanyBillingIncompleteReason extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        "insurance_company_id",
        "billing_incomplete_reason_id",
        "billing_company_id"
    ];
}
