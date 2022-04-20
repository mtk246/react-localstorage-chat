<?php

namespace App\Roles\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

use App\Roles\Contracts\RoleHasRelations as RoleHasRelationsContract;
use App\Roles\Traits\RoleHasRelations;
use App\Roles\Traits\Slugable;
/**
 * @class Role
 * @brief Modelo para la gestión de roles
 *
 * Gestiona información sobre los roles de acceso
 *
 * @author ultraware\roles <a href="https://github.com/ultraware/roles.git">Ultraware\Roles</a>
 */
class Role extends Model implements RoleHasRelationsContract, Auditable
{
    use Slugable, RoleHasRelations;
    use AuditableTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'level'];

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

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class)->withTimestamps();
    }
}
