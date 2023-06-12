<?php

declare(strict_types=1);

namespace App\Models\Claims;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Claims\ClaimAdditionalInformation
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Claims\ClaimDateInformation> $claimDateInformations
 * @property-read int|null $claim_date_informations_count
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimAdditionalInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimAdditionalInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimAdditionalInformation query()
 * @mixin \Eloquent
 */
final class ClaimAdditionalInformation extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = [
        'claim_id',
    ];

    public function patientAdditionalInformation()
    {
        return $this->hasOne(PatientAdditionalInformation::class);
    }

    /**
     * ClaimAdditionalInformation has many ClaimDateInformations.
     */
    public function claimDateInformations()
    {
        return $this->hasMany(ClaimDateInformation::class);
    }
}
