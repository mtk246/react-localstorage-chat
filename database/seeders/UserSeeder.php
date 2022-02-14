<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker;
use Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "username"       => Faker\Provider\en_US\Person::firstNameMale(),
            "email"      => "admin@billing.com",
            "password"   => bcrypt('helloworld'),
            "firstName"  => Faker\Provider\en_US\Person::firstNameMale(),
            "middleName" => Faker\Provider\en_US\Person::firstNameMale(),
            "lastName"   => Faker\Provider\en_US\Person::firstNameMale(),
            "sex"        => "M",
            //"DOB"        => now()->format("Y-m-d"),
        ]);

        $user->assignRole("SUPER_USER");
    }
}
