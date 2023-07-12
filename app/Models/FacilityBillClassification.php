<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

final class FacilityBillClassification extends Pivot
{
    use HasFactory;

    protected $table = "facility_bill_clasifications";
    
    protected $fillable = ["facility_id", "bill_classification_id"];
}
