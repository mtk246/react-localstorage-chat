<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\User\RoleType;
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
        $roles = collect(json_decode(\File::get('database/data/DefaultRoles.json')));

        $billingCompanies = BillingCompany::all(['id']);

        $roles->map(function (object $role) {
            $role->type = RoleType::from($role->type);

            return $role;
        })->each(function (object $role) use ($billingCompanies) {
            if ($role->admin ?? false) {
                Role::updateOrCreate(
                    ['billing_company_id' => null, 'slug' => $role->slug],
                    [
                        'name' => $role->name,
                        'description' => $role->description,
                        'type' => $role->type,
                    ]
                );

                return;
            }

            $billingCompanies->each(function (BillingCompany $billingCompany) use ($role) {
                Role::updateOrCreate(
                    ['billing_company_id' => $billingCompany->id, 'slug' => $role->slug],
                    [
                        'name' => $role->name,
                        'description' => $role->description,
                        'type' => $role->type,
                    ]
                );
            });
        });
    }
}
