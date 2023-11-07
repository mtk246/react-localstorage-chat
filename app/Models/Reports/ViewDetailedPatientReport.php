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
}
