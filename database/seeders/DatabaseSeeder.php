<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            FacilityTypeSeeder::class,
            ModifierSeeder::class,
            DiagnosisSeeder::class,
            //DataTestSeeder::class,
            //ServiceDataSeeder::class,
            ProcedureDataSeeder::class,
            SocialNetworkSeeder::class,
            MaritalStatusSeeder::class,
            HealthProfessionalTypeSeeder::class,
            InsurancePolicyTypeSeeder::class,
            ClearingHouseDataSeeder::class,
            TypeCatalogSeeder::class,
            ClaimDataSeeder::class,
            //DataTestSeeder::class
        ]);
    }
}
