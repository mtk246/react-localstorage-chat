<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * App\Models\ClaimFormIOccurrence
 *
 * @property int $id
 * @property string $date
 * @property string $code
 * @property string $through
 * @property int $claim_form_i_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\ClaimFormI $claimFormI
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereClaimFormIId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereThrough($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimFormIOccurrence whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @mixin \Eloquent
 */
class ClaimFormIOccurrence extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "through",
        "claim_form_i_id"
    ];

    /**
     * ClaimFormI belongs to ClaimFormIOccurrence.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claimFormI(): BelongsTo
    {
        return $this->belongsTo(ClaimFormI::class);
    }
}
