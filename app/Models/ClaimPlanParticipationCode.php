<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ClaimPlanParticipationCode extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "plan_participation_code"
    ];

    /**
     * ClaimPlanParticipationCode has many ClaimInformation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function claimInformations()
    {
        return $this->hasMany(ClaimInformation::class);
    }
}
