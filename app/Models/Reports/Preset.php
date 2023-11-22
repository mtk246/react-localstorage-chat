<?php

declare(strict_types=1);

namespace App\Models\Reports;

use App\Models\BillingCompany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Preset extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'description',
        'filter',
        'version',
        'is_private',
        'report_id',
        'user_id',
        'billing_company_id',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reports(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function billingCompanies(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }

    protected function filter(): Attribute
    {
        return new Attribute(
            get: fn (string $value) => json_decode($value),
            // set: fn (string $value) => json_encode($value),
        );
    }
}
