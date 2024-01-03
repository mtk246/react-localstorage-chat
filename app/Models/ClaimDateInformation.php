<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\ClaimDateInformation.
 *
 * @property int $id
 * @property string|null $from_date
 * @property string|null $to_date
 * @property string|null $description
 * @property int|null $field_id
 * @property int|null $qualifier_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $amount
 * @property int $claim_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\PhysicianOrSupplierInformation|null $physicianOrSupplierInformation
 * @property \App\Models\TypeCatalog|null $qualifier
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereFromDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereQualifierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereToDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class ClaimDateInformation extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $table = 'claim_date_informations';

    protected $fillable = [
        'from_date_or_current',
        'to_date',
        'description',
        'qualifier_id',
        'physician_or_supplier_information_id',
        'through',
        'amount',
    ];

    protected $with = ['qualifier'];

    /**
     * ClaimDateInformation belongs to Qualifier.
     */
    public function qualifier(): BelongsTo
    {
        return $this->belongsTo(TypeCatalog::class, 'qualifier_id');
    }

    /**
     * ClaimDateInformation belongs to PhysicianOrSupplierInformations.
     */
    public function physicianOrSupplierInformation(): BelongsTo
    {
        return $this->belongsTo(PhysicianOrSupplierInformation::class);
    }
}
