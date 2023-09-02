<?php

declare(strict_types=1);

namespace App\Models\ClearingHouse;

use App\Enums\Claim\ClaimType;
use App\Models\ClearingHouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class DataOfPayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpid',
        'paper_cpid',
        'portal',
        'type',
        'claim_insurance_type',
        'clearing_house_id',
        'available_payer_id',
    ];

    protected $casts = [
        'type' => ClaimType::class,
    ];

    /**
     * Get the availablePayer that owns the DataOfPayer.
     */
    public function availablePayer(): BelongsTo
    {
        return $this->belongsTo(AvailablePayer::class);
    }

    /**
     * Get the clearingHouse that owns the DataOfPayer.
     */
    public function clearingHouse(): BelongsTo
    {
        return $this->belongsTo(ClearingHouse::class);
    }
}
