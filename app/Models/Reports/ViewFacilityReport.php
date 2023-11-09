<?php

declare(strict_types=1);

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ViewFacilityReport extends Model
{
    use HasFactory;

    protected $table = 'view_facility_report';

    protected function billingCompaniesIds(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value),
        );
    }

    protected function billingCompanies(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value),
        );
    }

    protected function companies(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value),
        );
    }

    protected function placeOfService(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function typeOfFacility(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function billClassifications(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function claimsProcessed(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? $value : 0,
        );
    }
}
