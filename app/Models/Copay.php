<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Copay.
 *
 * @property int $id
 * @property int|null $billing_company_id
 * @property string|null $copay
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $private_note
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property int|null $companies_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePlan> $insurancePlans
 * @property int|null $insurance_plans_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Procedure> $procedures
 * @property int|null $procedures_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Copay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Copay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Copay query()
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereCopay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Copay wherePrivateNote($value)
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
        'billing_company_id',
        'private_note',
    ];

    /** @var string[] */
    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function procedures(): BelongsToMany
    {
        return $this->belongsToMany(Procedure::class)->withTimestamps();
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function insurancePlans(): BelongsToMany
    {
        return $this->belongsToMany(InsurancePlan::class)->withTimestamps();
    }
}
