<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permissions\Permission;
use App\Models\User\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        $oldPermissions = Permission::all();

        $permissions = collect(json_decode(\File::get('database/data/user/Permissions.json')));
        $defaultPermissions = collect(json_decode(\File::get('database/data/user/DefaultRolePermissions.json')));

        \DB::transaction(function () use ($roles, $permissions, $defaultPermissions, $oldPermissions) {
            $roles->each(function (Role $role) {
                $role->permissions()->detach();
            });

            foreach ($oldPermissions as $perm) {
                $perm->delete();
            }

            $permissions->each(function ($permission) use ($roles, $defaultPermissions) {
                $per = Permission::query()->updateOrCreate([
                    'slug' => $permission->slug,
                    ],
                    [
                        'name' => $permission->name,
                        'module' => $permission->module ?? '',
                        'constraint' => $permission->constraint ?? '',
                        'description' => $permission->description,
                    ]
                );

                $per->save();

                $roles->each(function (Role $role) use ($defaultPermissions, $per) {
                    if ($defaultPermissions->has($role->slug)) {
                        if (in_array($per->slug, (array) $defaultPermissions->get($role->slug))) {
                            $role->permissions()->syncWithPivotValues($per->id, ['authorizable_type' => Role::class], false);
                        }
                    }
                });
            });
        });
    }
}
