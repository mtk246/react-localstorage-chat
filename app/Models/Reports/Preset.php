<?php

declare(strict_types=1);

namespace App\Models\Reports;

use App\Models\BillingCompany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Reports\Preset.
 *
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property bool $is_private
 * @property string|null $version
 * @property mixed $filter
 * @property string|null $report_id
 * @property int|null $user_id
 * @property int $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property BillingCompany|null $billingCompanies
 * @property \App\Models\Reports\Report|null $reports
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Preset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Preset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Preset query()
 * @method static \Illuminate\Database\Eloquent\Builder|Preset whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preset whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preset whereFilter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preset whereIsPrivate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preset whereReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preset whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preset whereVersion($value)
 *
 * @mixin \Eloquent
 */
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
        );
    }
}
