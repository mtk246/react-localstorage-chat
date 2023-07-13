<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

final class BillClassificationFacilityType extends Pivot
{
    use HasFactory;

    protected $fillable = ['bill_classification_id', 'facility_type_id'];
}
