<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\BillClassificationFacility.
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $facility_id
 * @property int $bill_classification_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillClassification $billClassification
 * @property \App\Models\Facility $facility
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassificationFacility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassificationFacility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassificationFacility query()
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassificationFacility whereBillClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassificationFacility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassificationFacility whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassificationFacility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BillClassificationFacility whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class BillClassificationFacility extends Pivot implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    public $incrementing = true;

    public function billClassification()
    {
        return $this->belongsTo(BillClassification::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
