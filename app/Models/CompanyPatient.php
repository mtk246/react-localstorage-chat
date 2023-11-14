<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class CompanyPatient extends Model
{
    use HasFactory;

    protected $table = 'company_patient';

    protected $fillable = [
        'company_id',
        'patient_id',
        'med_num',
        'billing_company_id',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }
}
