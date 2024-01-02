<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\FacilityPlaceOfService.
 *
 * @property int $id
 * @property int $facility_id
 * @property int $place_of_service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $billing_company_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Facility $facility
 * @property \App\Models\PlaceOfService|null $placeOfServices
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityPlaceOfService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityPlaceOfService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityPlaceOfService query()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityPlaceOfService whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityPlaceOfService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityPlaceOfService whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityPlaceOfService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityPlaceOfService wherePlaceOfServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityPlaceOfService whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class FacilityPlaceOfService extends Pivot implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    public $incrementing = true;

    public function placeOfServices()
    {
        return $this->belongsTo(PlaceOfService::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
