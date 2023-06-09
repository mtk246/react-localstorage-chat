<?php

declare(strict_types=1);

namespace App\Models\v2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

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
