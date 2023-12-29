<?php

declare(strict_types=1);

namespace App\Models;

use App\Roles\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditing\CustomAuditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\IpRestriction.
 *
 * @property int $id
 * @property int|null $billing_company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $entity
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \App\Models\BillingCompany|null $billingCompany
 * @property mixed $last_modified
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestrictionMult> $ipRestrictionMults
 * @property int|null $ip_restriction_mults_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Role> $roles
 * @property int|null $roles_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property int|null $users_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction query()
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereBillingCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IpRestriction whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
final class IpRestriction extends Model implements Auditable
{
    use HasFactory;
    use AuditableTrait;

    protected $fillable = ['entity', 'billing_company_id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['last_modified'];

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
    public function ipRestrictionMults()
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

    public function getLastModifiedAttribute()
    {
        $record = [
            'user' => '',
            'roles' => [],
        ];
        $lastModified = $this->audits()->latest()->first();
        if (!isset($lastModified->user_id)) {
            return [
                'user' => 'Console',
                'roles' => [],
            ];
        } else {
            $user = User::find($lastModified->user_id);

            return [
                'user' => $user->profile->first_name.' '.$user->profile->last_name,
                'roles' => $user->roles()?->get(['name'])->pluck('name'),
            ];
        }
    }

    public function scopeSearch($query, $search)
    {
        if ('' != $search) {
            return $query->whereHas('billingCompany', function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE (?)', [strtolower("%$search%")])
                ->orWhereRaw('LOWER(code) LIKE (?)', [strtolower("%$search%")]);
            })->orWhereHas('IpRestrictionMults', function ($q) use ($search) {
                $q->whereRaw('LOWER(ip_beginning) LIKE (?)', [strtolower("%$search%")])
                ->orWhereRaw('LOWER(ip_finish) LIKE (?)', [strtolower("%$search%")]);
            })->orWhereRaw('LOWER(entity) LIKE (?)', [strtolower("%$search%")]);
        }

        return $query;
    }
}
