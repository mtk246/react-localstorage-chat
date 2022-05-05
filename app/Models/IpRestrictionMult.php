<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class IpRestrictionMult  extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = ['ip_beginning', 'ip_finish', 'rank', 'ip_restriction_id'];

    /**
     * The billingCompanies that belong to the ip restriction.
     *
     * @return BelongsTo
     */
    public function ipRestriction()
    {
        return $this->belongsTo(IpRestriction::class);
    }
}
