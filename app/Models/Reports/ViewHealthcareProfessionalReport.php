<?php

declare(strict_types=1);

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ViewHealthcareProfessionalReport extends Model
{
    use HasFactory;
    protected $table = 'view_healthcare_professional_report';

    protected function healthProfessionalType(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => getHealthcareType($value),
        );
    }

    protected function healthProfessionalRole(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => getHealthcareAuthorization($value),
        );
    }
}
