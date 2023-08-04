<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\BillingCompany\MembershipRole;
use App\Roles\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::transaction(function () {
            $roles = [
                [
                    'name' => 'Super User',
                    'slug' => 'superuser',
                    'description' => 'Allows you to administer and manage all the functions of the application',
                    'level' => 1,
                ],
                [
                    'name' => 'Billing Manager',
                    'slug' => 'billingmanager',
                    'description' => 'Allows you to administer and manage all the functions of the application associated with a billing company',
                    'level' => 2,
                ],
                [
                    'name' => 'Billing Worker',
                    'slug' => 'billingworker',
                    'description' => 'worker of a billing company',
                    'level' => 3,
                ],
                [
                    'name' => 'Health Professional',
                    'slug' => 'healthprofessional',
                    'description' => 'Allows access to system functions for health professional management',
                    'level' => 4,
                ],
                [
                    'name' => 'Patient',
                    'slug' => 'patient',
                    'description' => 'Allows access to system functions for patient management',
                    'level' => 4,
                ],
                [
                    'name' => 'Client',
                    'slug' => 'client',
                    'description' => 'Allows access to system functions for customer management',
                    'level' => 4,
                ],
                [
                    'name' => 'Development Support',
                    'slug' => 'developmentsupport',
                    'description' => 'Allows access to system functions for development support management',
                    'level' => 5,
                ],
                [
                    'name' => 'Super Auditor',
                    'slug' => 'superauditor',
                    'description' => 'Allows access to system functions for audit management',
                    'level' => 6,
                ],
                [
                    'name' => 'Billing Company Auditor',
                    'slug' => 'billingcompanyauditor',
                    'description' => 'Allows access to system functions for audit management by billing company',
                    'level' => 7,
                ],
            ];

            foreach ($roles as $role) {
                Role::updateOrCreate(
                    ['slug' => $role['slug']],
                    [
                        'name' => $role['name'],
                        'description' => $role['description'],
                        'level' => $role['level'],
                    ]
                );
            }

            collect(json_decode(\File::get('database/data/MembershipRoles.json')))
                ->map(function ($role, $key) {
                    return (array) $role;
                })
                ->chunk(1000)
                ->each(fn ($chunk) => MembershipRole::upsert($chunk->toArray(), ['id']));
        });
    }
}
