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
        Role::create([
            "name" => "SUPER_USER"
        ]);

        Role::create([
            "name" => "BILLING_MANAGER"
        ]);

        Role::create([
            "name" => "BILLER"
        ]);

        Role::create([
            "name" => "COLLECTOR"
        ]);

        Role::create([
            "name" => "PAYMENT_PROCESSOR"
        ]);

        Role::create([
            "name" => "ACCOUNT_MANAGER"
        ]);

        Role::create([
            "name" => "DEVELOPMENT_SUPPORT"
        ]);

        Role::create([
            "name" => "DOCTOR"
        ]);

        Role::create([
            "name" => "PATIENT"
        ]);

        Role::create([
            "name" => "CLIENT"
        ]);
    }
}
