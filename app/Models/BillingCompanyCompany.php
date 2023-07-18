<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

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
