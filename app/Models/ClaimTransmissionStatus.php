<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Model;

class ClaimTransmissionStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        "status", "background_color", "font_color"
    ];

    /**
     * ClaimTransmissionStatus has many ClaimTransmissionResponses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ClaimTransmissionResponses()
    {
        return $this->hasMany(ClaimTransmissionResponse::class);
    }
}
