<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimDateInformation
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Claims\ClaimAdditionalInformation|null $claimAdditionalInformation
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimDateInformation query()
 * @mixin \Eloquent
 */
final class ClaimDateInformation extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'from_date_or_current',
        'to_date',
        'description',
        'field_id',
        'qualifier_id',
        'through',
        'amount',
        'claim_additional_information_id',
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
     * ClaimDateInformation belongs to ClaimAdditionalInformations.
     */
    public function claimAdditionalInformation(): BelongsTo
    {
        return $this->belongsTo(ClaimAdditionalInformation::class);
    }
}
