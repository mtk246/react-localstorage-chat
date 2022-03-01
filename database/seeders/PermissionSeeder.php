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
        $permissions = [
            ["name" => "Manage permissions for each role"],
            ["name" => "Create Billing Company"],
            ["name" => "View Billing Companies"],
            ["name" => "View Billing Company"],
            ["name" => "Create User"],
            ["name" => "View User"],
            ["name" => "Create Company"],
            ["name" => "View Companies"],
            ["name" => "Create Facility"],
            ["name" => "View Facilities"],
            ["name" => "Create Clearinghouse"],
            ["name" => "View Clearinghouse"],
            ["name" => "Create Insurance Company"],
            ["name" => "View Insurance Company"],
            ["name" => "Create Insurance"],
            ["name" => "View Insurance"],
            ["name" => "Create Doctor or Physician"],
            ["name" => "View Doctor or Physician"],
            ["name" => "Register a Patient"],
            ["name" => "Update or verify personal information"],
            ["name" => "Update or verify insurance policy information"],
            ["name" => "Create Claim"],
            ["name" => "Verification and debuggin claim /Send claim"],
            ["name" => "Correct and re-submit claim"],
            ["name" => "Generate Appeal"],
            ["name" => "View Claims"],
            ["name" => "Manage users responsible for a claims"],
            ["name" => "Register Payment"],
            ["name" => "Generate patient accounts statements"],
            ["name" => "Send co-pays and co-insurance"],
            ["name" => "Generate Reports"],
            ["name" => "View Reports"],
            ["name" => "Generate error report"],
            ["name" => "Manage responses in the FAQ forum"],
            ["name" => "View Profile"],
        ];

        foreach ($permissions as $perm) {
            Permission::updateOrCreate(
                ['name' => $perm['name']],
                ['name' => $perm['name']],
            );
        }
    }
}
