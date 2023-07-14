<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class BillClassification extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'facility_type_id'];

    /**
     * Facility belongsToMany with BillClassification.
     */
    public function facilities()
    {
        return $this->belongsToMany(Facility::class);
    }

    public function facility_types(): BelongsToMany
    {
        return $this->belongsToMany(FacilityType::class);
    }
}
