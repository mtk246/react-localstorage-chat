<?php

declare(strict_types=1);

namespace App\Roles\Models;

use App\Roles\Contracts\RoleHasRelations as RoleHasRelationsContract;
use App\Roles\Traits\RoleHasRelations;
use App\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Roles\Models\Role.
 *
 * @class Role
 *
 * @brief Modelo para la gestión de roles
 *
 * Gestiona información sobre los roles de acceso
 *
 * @author ultraware\roles <a href="https://github.com/ultraware/roles.git">Ultraware\Roles</a>
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property int|null $ip_restrictions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $permissions
 * @property int|null $permissions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property int|null $users_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $permissions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\IpRestriction> $ipRestrictions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Permission> $permissions
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 *
 * @mixin \Eloquent
 */
class Role extends Model implements RoleHasRelationsContract, Auditable
{
    use Slugable;
    use RoleHasRelations;
    use AuditableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'level'];

    /**
     * Create a new model instance.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection = config('roles.connection')) {
            $this->connection = $connection;
        }
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class)->withTimestamps();
    }

    /**
     * Role has many IpRestrictions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ipRestrictions()
    {
        return $this->hasMany(\App\Models\IpRestriction::class);
    }
}
