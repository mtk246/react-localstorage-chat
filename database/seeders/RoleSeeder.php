<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Roles\Models\Role;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $roles = [
                [
                    'name' => 'Super User',
                    'slug' => 'superuser',
                    'description' => 'Allows you to administer and manage all the functions of the application',
                    'level' => 1
                ],
                [
                    'name' => 'Billing Manager',
                    'slug' => 'billingmanager',
                    'description' => 'Allows you to administer and manage all the functions of the application associated with a billing company',
                    'level' => 2
                ],
                [
                    'name' => 'Biller',
                    'slug' => 'biller',
                    'description' => 'Allows access to system functions for biller management',
                    'level' => 3
                ],
                [
                    'name' => 'Payment Processor',
                    'slug' => 'paymentprocessor',
                    'description' => 'Allows access to system functions for payment processor management',
                    'level' => 3
                ],
                [
                    'name' => 'Collector',
                    'slug' => 'collector',
                    'description' => 'Allows access to system functions for collector management',
                    'level' => 3
                ],
                [
                    'name' => 'Account Manager',
                    'slug' => 'accountmanager',
                    'description' => 'Allows access to system functions for account manager management',
                    'level' => 3
                ],
                [
                    'name' => 'Health Professional',
                    'slug' => 'healthprofessional',
                    'description' => 'Allows access to system functions for health professional management',
                    'level' => 4
                ],
                [
                    'name' => 'Patient',
                    'slug' => 'patient',
                    'description' => 'Allows access to system functions for patient management',
                    'level' => 4
                ],
                [
                    'name' => 'Client',
                    'slug' => 'client',
                    'description' => 'Allows access to system functions for customer management',
                    'level' => 4
                ],
                [
                    'name' => 'Development Support',
                    'slug' => 'developmentsupport',
                    'description' => 'Allows access to system functions for development support management',
                    'level' => 5
                ],
                [
                    'name' => 'Super Auditor',
                    'slug' => 'superauditor',
                    'description' => 'Allows access to system functions for audit management',
                    'level' => 6
                ],
                [
                    'name' => 'Billing Company Auditor',
                    'slug' => 'billingcompanyauditor',
                    'description' => 'Allows access to system functions for audit management by billing company',
                    'level' => 7
                ],
            ];

            foreach ($roles as $role) {
                Role::updateOrCreate(
                    ['slug' => $role['slug']],
                    [
                        'name'        => $role['name'],
                        'description' => $role['description'],
                        'level'       => $role['level']
                    ]
                );
            }
        });
    }
}
