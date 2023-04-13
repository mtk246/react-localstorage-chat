<?php

declare(strict_types=1);

namespace App\Models\Reports;

use App\Enums\Reports\ReportType;
use App\Models\BillingCompany;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Reports\Report.
 *
 * @property string $uuid
 * @property string $name
 * @property string $use
 * @property string $description
 * @property ReportType $type
 * @property array $tags
 * @property array $configuration
 * @property \Illuminate\Support\Carbon $range
 * @property bool $favorite
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property BillingCompany|null $billingCompany
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereConfiguration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereFavorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Report whereUuid($value)
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
        'use',
        'description',
        'type',
        'range',
        'tags',
        'configuration',
        'favorite',
        'billing_company_id',
    ];

    /** @var array<key, string> */
    protected $casts = [
        'type' => ReportType::class,
        'tags' => 'json',
        'configuration' => 'json',
        'favorite' => 'boolean',
    ];

    public function billingCompany(): BelongsTo
    {
        return $this->belongsTo(BillingCompany::class);
    }
}
