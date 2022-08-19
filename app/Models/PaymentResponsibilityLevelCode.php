<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PaymentResponsibilityLevelCode extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        "payment_responsibility_level_code"
    ];

    /**
     * PaymentResponsibilityLevelCode has many Subscriber.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }
}
