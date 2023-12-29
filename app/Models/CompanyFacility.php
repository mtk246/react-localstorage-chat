<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\CompanyFacility.
 *
 * @property int $id
 * @property int $company_id
 * @property int $facility_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $billing_company_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Company $company
 * @property \App\Models\Facility $facility
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyFacility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyFacility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyFacility query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyFacility whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyFacility whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyFacility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyFacility whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyFacility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyFacility whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class CompanyFacility extends Pivot implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    public $incrementing = true;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
