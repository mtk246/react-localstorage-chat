<?php

declare(strict_types=1);

namespace App\Roles\Contracts;

use App\Roles\Models\Permission;
use App\Roles\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Interface para la gestión de roles y permisos.
 *
 * @author ultraware\roles <a href="https://github.com/ultraware/roles.git">Ultraware\Roles</a>
 */
interface HasRoleAndPermission
{
    /**
     * User belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles();

    /**
     * Get all roles as collection.
     *
     * @return Collection
     */
    public function getRoles();

    /**
     * Check if the user has a role or roles.
     *
     * @param int|string|array $role
     * @param bool $all
     *
     * @return bool
     */
    public function hasRole($role, $all = false);

    /**
     * Check if the user has at least one of the given roles.
     *
     * @param int|string|array $role
     *
     * @return bool
     */
    public function hasOneRole($role);

    /**
     * Check if the user has all roles.
     *
     * @param int|string|array $role
     *
     * @return bool
     */
    public function hasAllRoles($role);

    /**
     * Check if the user has role.
     *
     * @param int|string $role
     *
     * @return bool
     */
    public function checkRole($role);

    /**
     * Attach role to a user.
     *
     * @param int|Role $role
     *
     * @return bool|null
     */
    public function attachRole($role);

    /**
     * Detach role from a user.
     *
     * @param int|Role $role
     *
     * @return int
     */
    public function detachRole($role);

    /**
     * Detach all roles from a user.
     *
     * @return int
     */
    public function detachAllRoles();

    /**
     * Sync roles for a user.
     *
     * @param array|Role[]|Collection $roles
     *
     * @return array
     */
    public function syncRoles($roles);

    /**
     * Get role level of a user.
     *
     * @return int
     */
    public function level();

    /**
     * Get all permissions from roles.
     *
     * @return Builder
     */
    public function rolePermissions();

    /**
     * User belongs to many permissions.
     *
     * @return BelongsToMany
     */
    public function userPermissions();

    /**
     * Get all permissions as collection.
     *
     * @return Collection
     */
    public function getPermissions();

    /**
     * Check if the user has a permission or permissions.
     *
     * @param int|string|array $permission
     * @param bool $all
     *
     * @return bool
     */
    public function hasPermission($permission, $all = false);

    /**
     * Check if the user has at least one of the given permissions.
     *
     * @param int|string|array $permission
     *
     * @return bool
     */
    public function hasOnePermission($permission);

    /**
     * Check if the user has all permissions.
     *
     * @param int|string|array $permission
     *
     * @return bool
     */
    public function hasAllPermissions($permission);

    /**
     * Check if the user has a permission.
     *
     * @param int|string $permission
     *
     * @return bool
     */
    public function checkPermission($permission);

    /**
     * Attach permission to a user.
     *
     * @param int|Permission $permission
     *
     * @return bool|null
     */
    public function attachPermission($permission);

    /**
     * Detach permission from a user.
     *
     * @param int|Permission $permission
     *
     * @return int
     */
    public function detachPermission($permission);

    /**
     * Detach all permissions from a user.
     *
     * @return int
     */
    public function detachAllPermissions();

    /**
     * Sync permissions for a user.
     *
     * @param array|Permission[]|Collection $permissions
     *
     * @return array
     */
    public function syncPermissions($permissions);
}
