<?php

namespace App\Roles\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

use App\Roles\Contracts\PermissionHasRelations as PermissionHasRelationsContract;
use App\Roles\Traits\PermissionHasRelations;
use App\Roles\Traits\Slugable;

/**
 * @class Permission
 * @brief Modelo para la gestión de permisos
 *
 * Gestiona información sobre los permisos de acceso
 *
 * @author ultraware\roles <a href="https://github.com/ultraware/roles.git">Ultraware\Roles</a>
 */
class Permission extends Model implements PermissionHasRelationsContract, Auditable
{
    use Slugable, PermissionHasRelations;
    use AuditableTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'module'];

    /**
     * Create a new model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection = config('roles.connection')) {
            $this->connection = $connection;
        }
    }
}
