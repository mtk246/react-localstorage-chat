<?php

declare(strict_types=1);

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ViewDetailedPatientReport extends Model
{
    use HasFactory;
    protected $table = 'view_detailed_patient_report';

    protected function claimsProcessed(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => $value ? $value : 0,
        );
    }

    public function scopeAllGeneralPatient($query)
    {
        return $query->select([
            'billing_companies',
            'companies',
            'medical_no',
            'system_code',
            'patiente_name',
            'date_of_birth',
            'sex',
            'claims_processed',
        ])->paginate()->toArray();
    }

    public function scopeAllPatientBillingManager($query)
    {
        return $query->select([
            'billing_companies_ids',
            'companies',
            'medical_no',
            'claims_processed',
            'system_code',
            'patiente_name',
            'date_of_birth',
            'sex',
            'ssn',
            'driver_license',
            'language',
            'name',
            'phone',
            'cell_phone',
            'fax',
            'email',
            'type_address',
            'address',
            'apt_suite',
            'zip',
            'city',
            'state',
            'country',
        ])->paginate()->toArray();
    }

    public function scopeAllGeneralPatientBillingManager($query)
    {
        return $query->select([
            'billing_companies_ids',
            'companies',
            'medical_no',
            'system_code',
            'patiente_name',
            'date_of_birth',
            'sex',
            'claims_processed',
        ])->paginate()->toArray();
    }
}
