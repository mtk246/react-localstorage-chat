<?php

declare(strict_types=1);

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Present extends Model
{
    use HasFactory;
    use HasUlids;

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function billingCompanies(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
