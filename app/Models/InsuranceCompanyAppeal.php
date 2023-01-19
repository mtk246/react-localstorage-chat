<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

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
