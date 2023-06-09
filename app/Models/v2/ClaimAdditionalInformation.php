<?php

declare(strict_types=1);

namespace App\Models\v2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

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
