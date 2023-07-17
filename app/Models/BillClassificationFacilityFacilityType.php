<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

final class BillClassificationFacilityFacilityType extends Pivot
{
    use HasFactory;

    protected $table = 'bill_classification_facility_facility_type';

    protected $fillable = ['facility_id', 'facility_type_id', 'bill_classification_id'];
}
