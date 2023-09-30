<?php

declare(strict_types=1);

namespace App\Models\Reports;

use App\Enums\Reports\ClassificationType;
use App\Enums\Reports\ReportType;
use App\Models\BillingCompany;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Reports\Report.
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property ReportType $type
 * @property array $configuration
 * @property string $range
 * @property bool $favorite
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property ClassificationType $clasification
 * @property BillingCompany|null $billingCompany
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereClasification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereConfiguration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereFavorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Report extends Model
{
    use HasFactory;
    use HasUlids;

    /** @var string[] */
    protected $fillable = [
        'name',
        'description',
        'type',
        'range',
        'clasification',
        'configuration',
        'favorite',
        'billing_company_id',
    ];

    /** @var array<key, string> */
    protected $casts = [
        'type' => ReportType::class,
        'clasification' => ClassificationType::class,
        'configuration' => 'json',
        'favorite' => 'boolean',
    ];

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }
}
