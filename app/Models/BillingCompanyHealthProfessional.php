<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

final class BillingCompanyHealthProfessional extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = 'billing_company_health_professional';

    protected $fillable = [
        'status',
        'billing_company_id',
        'health_professional_id',
        'npi_company',
        'is_provider',
        'company_id',
        'health_professional_type_id',
    ];

    public function healthProfessional()
    {
        return $this->belongsTo(HealthProfessional::class);
    }

    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class, 'billing_company_id');
    }
}
