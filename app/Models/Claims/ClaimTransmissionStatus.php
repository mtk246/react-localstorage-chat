<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class ClaimTransmissionStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'background_color', 'font_color',
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
