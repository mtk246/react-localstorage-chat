<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

final class TypeOfFacility extends Pivot
{
    use HasFactory;

    protected $table = 'type_of_facility';

    protected $fillable = ['facility_id', 'facility_type_id'];
}
