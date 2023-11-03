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

    protected function billingCompaniesIds(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function billingCompanies(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function companies(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function medicalNo(): Attribute
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

    protected function typeAddress(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function address(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function aptSuite(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function zip(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function city(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function state(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

    protected function country(): Attribute
    {
        return Attribute::make(
            get: fn (string | null $value) => $value ? json_decode($value) : [],
        );
    }

}
