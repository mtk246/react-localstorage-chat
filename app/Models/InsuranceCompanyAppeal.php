<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class InsuranceCompanyAppeal extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        "insurance_company_id",
        "appeal_id"
        "billing_company_id"
    ];
}
