<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Roles\Models\Role;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class IpRestriction extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $fillable = ['entity', 'billing_company_id'];

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
     * IpRestriction has many IpRestrictionMults.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function IpRestrictionMults()
    {
        return $this->hasMany(IpRestrictionMult::class);
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

    /**
     * IpRestriction is morphed by many Roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphedByMany
     */
    public function roles()
    {
        return $this->morphedByMany(Role::class, 'restrictable');
    }
}
