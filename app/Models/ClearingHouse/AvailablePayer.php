<?php

declare(strict_types=1);

namespace App\Models\ClearingHouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class AvailablePayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'payer_id',
        'name',
    ];

    /**
     * Get all of the dataOfPayers for the AvailablePayer.
     */
    public function dataOfPayers(): HasMany
    {
        return $this->hasMany(DataOfPayer::class);
    }
}
