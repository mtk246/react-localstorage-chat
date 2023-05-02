<?php

declare(strict_types=1);

namespace App\Roles\Models;

use App\Roles\Contracts\PermissionHasRelations as PermissionHasRelationsContract;
use App\Roles\Traits\PermissionHasRelations;
use App\Roles\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Roles\Models\Permission.
 *
 * @class Permission
 *
 * @brief Modelo para la gestión de permisos
 *
 * Gestiona información sobre los permisos de acceso
 *
 * @author ultraware\roles <a href="https://github.com/ultraware/roles.git">Ultraware\Roles</a>
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $module
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $constraint
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property int|null $audits_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Role> $roles
 * @property int|null $roles_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property int|null $users_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereConstraint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Role> $roles
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audit> $audits
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Roles\Models\Role> $roles
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 *
 * @mixin \Eloquent
 */
class Permission extends Model implements PermissionHasRelationsContract, Auditable
{
    use Slugable;
    use PermissionHasRelations;
    use AuditableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'module', 'constraint'];

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
}
