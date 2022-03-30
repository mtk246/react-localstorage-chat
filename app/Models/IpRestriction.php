<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class IpRestriction extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = ['ip_beginning', 'ip_finish', 'rank', 'billing_company_id']

    /**
     * The billingCompanies that belong to the ip restriction.
     *
     * @return BelongsTo
     */
    public function billingCompany()
    {
        return $this->belongsTo(BillingCompany::class);
    }

    /**
     * The users that belong to the ip restriction.
     *
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('rank')->withTimestamps();
    }

    /**
     * IpRestriction is morphed by many Users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'restrictable');
    }
}
