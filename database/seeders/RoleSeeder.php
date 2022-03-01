<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ["name" => "SUPER_USER"],
            ["name" => "BILLING_MANAGER"],
            ["name" => "BILLER"],
            ["name" => "COLLECTOR"],
            ["name" => "PAYMENT_PROCESSOR"],
            ["name" => "ACCOUNT_MANAGER"],
            ["name" => "DEVELOPMENT_SUPPORT"],
            ["name" => "DOCTOR"],
            ["name" => "PATIENT"],
            ["name" => "CLIENT"],

        ];
        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                ['name' => $role['name']],
            );
        }
    }
}
