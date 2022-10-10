<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PayerResponsibility extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "code",
        "description"
    ];

    /**
     * PayerResponsibility has many InsurancePolicies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insurancePolicies()
    {
        return $this->hasMany(InsurancePolicy::class);
    }
}
