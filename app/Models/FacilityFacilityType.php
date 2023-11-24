<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\FacilityFacilityType.
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $facility_id
 * @property int $facility_type_id
 * @property mixed|null $bill_classifications
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Facility $facility
 * @property \App\Models\FacilityType $facilityType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityFacilityType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityFacilityType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityFacilityType query()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityFacilityType whereBillClassifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityFacilityType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityFacilityType whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityFacilityType whereFacilityTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityFacilityType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityFacilityType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class FacilityFacilityType extends Pivot implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $casts = [
        'bill_classifications' => 'json',
    ];

    public $incrementing = true;

    public function facilityType()
    {
        return $this->belongsTo(FacilityType::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
