<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\BillingCompany;
use App\Models\User\Role;
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
                    'admin' => true,
                ],
                [
                    'name' => 'Health Professional',
                    'slug' => 'healthprofessional',
                    'description' => 'Allows access to system functions for health professional management',
                    'admin' => true,
                ],
                [
                    'name' => 'Patient',
                    'slug' => 'patient',
                    'description' => 'Allows access to system functions for patient management',
                    'admin' => true,
                ],
                [
                    'name' => 'Super Auditor',
                    'slug' => 'superauditor',
                    'description' => 'Allows access to system functions for audit management',
                    'admin' => true,
                ],
                [
                    'name' => 'Development Support',
                    'slug' => 'developmentsupport',
                    'description' => 'Allows access to system functions for development support management',
                    'admin' => true,
                ],
                [
                    'name' => 'Billing Manager',
                    'slug' => 'billingmanager',
                    'description' => 'Allows you to administer and manage all the functions of the application associated with a billing company',
                    'level' => 2,
                ],
                [
                    'name' => 'Biller',
                    'slug' => 'biller',
                    'description' => 'worker of a billing company',
                    'level' => 3,
                ],
                [
                    'name' => 'Client',
                    'slug' => 'client',
                    'description' => 'Allows access to system functions for customer management',
                    'level' => 4,
                ],
                [
                    'name' => 'Payment Processor',
                    'slug' => 'paymentprocessor',
                    'description' => 'Allows access to system functions for development support management',
                    'level' => 5,
                ],
                [
                    'name' => 'Collector',
                    'slug' => 'collector',
                    'description' => 'Allows access to system functions for audit management by billing company',
                    'level' => 7,
                ],
                [
                    'name' => 'Account Manager',
                    'slug' => 'accountmanager',
                    'description' => 'Allows access to system functions for audit management by billing company',
                    'level' => 7,
                ],
                [
                    'name' => 'Billing Auditor',
                    'slug' => 'billingauditor',
                    'description' => 'Allows access to system functions for audit management by billing company',
                    'level' => 7,
                ],
            ];

            $billingCompanies = BillingCompany::all();

            foreach ($roles as $role) {
                if ($role['admin'] ?? false) {
                    Role::updateOrCreate(
                        ['billing_company_id' => null, 'slug' => $role['slug']],
                        [
                            'name' => $role['name'],
                            'description' => $role['description'],
                        ]
                    );

                    continue;
                }

                $billingCompanies->each(function (BillingCompany $billingCompany) use ($role) {
                    Role::updateOrCreate(
                        ['billing_company_id' => $billingCompany->id, 'slug' => $role['slug']],
                        [
                            'name' => $role['name'],
                            'description' => $role['description'],
                        ]
                    );
                });
            }
        });
    }
}
