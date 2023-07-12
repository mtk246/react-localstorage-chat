<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

final class FacilityTypeBillClassification extends Pivot
{
    use HasFactory;

    protected $table = "facility_type_bill_classifications";
    
    protected $fillable = ["bill_classification_id", "facility_type_id"];

}
