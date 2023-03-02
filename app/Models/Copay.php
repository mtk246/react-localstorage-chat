<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Copay.
 *
 * @todo compleate model structure
 *
 * @property int $id
 * @property int|null $billing_company_id
 * @property int|null $insurance_plan_id
 * @property int|null $company_id
 * @property string|null $copay
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Company|null $company
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Copay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Copay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Copay query()
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereCopay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereInsurancePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class Copay extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    /** @var string[] */
    protected $fillable = [
        'copay',
        'company_id',
        'insurance_plan_id',
        'billing_company_id',
    ];

    /** @var string[] */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function procedures(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class)->withTimestamps();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
