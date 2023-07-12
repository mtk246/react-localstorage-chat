<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class BillClassification extends Model
{
    use HasFactory;

    protected $table = "bill_classifications";

    protected $fillable = ['name', 'facility_type_id'];

    /**
     * Facility belongsToMany with BillClassification
     */
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_bill_clasifications')->using(FacilityBillClassification::class);
    }

}
