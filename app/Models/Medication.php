<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Medication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'date',
        'drug_code',
        'batch',
        'quantity',
        'frequency',
    ];

    public function companyProcedure(): BelongsTo
    {
        return $this->belongsTo(CompanyProcedure::class);
    }
}
