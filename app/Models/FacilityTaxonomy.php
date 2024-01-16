<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\FacilityTaxonomy.
 *
 * @property int $id
 * @property int $facility_id
 * @property int $taxonomy_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $billing_company_id
 * @property bool $primary
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\Facility $facility
 * @property \App\Models\Taxonomy $taxonomy
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityTaxonomy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityTaxonomy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityTaxonomy query()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityTaxonomy whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityTaxonomy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityTaxonomy whereFacilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityTaxonomy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityTaxonomy wherePrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityTaxonomy whereTaxonomyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityTaxonomy whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class FacilityTaxonomy extends Pivot implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    public $incrementing = true;

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }
}
