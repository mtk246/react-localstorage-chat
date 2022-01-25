<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class  PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            "name" => "Manage permissions for each role"
        ]);

        Permission::create([
            "name" => "Create Billing Company"
        ]);

        Permission::create([
            "name" => "View Billing Companies"
        ]);

        Permission::create([
            "name" => "View Billing Company"
        ]);

        Permission::create([
            "name" => "Create User"
        ]);

        Permission::create([
            "name" => "View User"
        ]);

        Permission::create([
            "name" => "Create Company"
        ]);

        Permission::create([
            "name" => "View Companies"
        ]);

        Permission::create([
            "name" => "Create Facility"
        ]);

        Permission::create([
            "name" => "View Facilities"
        ]);

        Permission::create([
            "name" => "Create Clearinghouse"
        ]);

        Permission::create([
            "name" => "View Clearinghouse"
        ]);

        Permission::create([
            "name" => "Create Insurance Company"
        ]);

        Permission::create([
            "name" => "View Insurance Company"
        ]);

        Permission::create([
            "name" => "Create Insurance"
        ]);

        Permission::create([
            "name" => "View Insurance"
        ]);

        Permission::create([
            "name" => "Create Doctor or Physician"
        ]);

        Permission::create([
            "name" => "View Doctor or Physician"
        ]);

        Permission::create([
            "name" => "Register a Patient"
        ]);

        Permission::create([
            "name" => "Update or verify personal information"
        ]);

        Permission::create([
            "name" => "Update or verify insurance policy information"
        ]);

        Permission::create([
            "name" => "Create Claim"
        ]);

        Permission::create([
            "name" => "Verification and debuggin claim /Send claim"
        ]);

        Permission::create([
            "name" => "Correct and re-submit claim"
        ]);

        Permission::create([
            "name" => "Generate Appeal"
        ]);

        Permission::create([
            "name" => "View Claims"
        ]);

        Permission::create([
            "name" => "Manage users responsible for a claims"
        ]);

        Permission::create([
            "name" => "Register Payment"
        ]);

        Permission::create([
            "name" => "Generate patient accounts statements"
        ]);

        Permission::create([
            "name" => "Send co-pays and co-insurance"
        ]);

        Permission::create([
            "name" => "Generate Reports"
        ]);

        Permission::create([
            "name" => "View Reports"
        ]);

        Permission::create([
            "name" => "Generate error report"
        ]);

        Permission::create([
            "name" => "Manage responses in the FAQ forum"
        ]);

        Permission::create([
            "name" => "View Profile"
        ]);
    }
}
