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
        $users = [
            [
                "username"   => Faker\Provider\en_US\Person::firstNameMale(),
                "email"      => "admin@billing.com",
                "ssn"        => randomNumber(9),
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "firstName"  => Faker\Provider\en_US\Person::firstNameMale(),
                "middleName" => Faker\Provider\en_US\Person::firstNameMale(),
                "lastName"   => Faker\Provider\en_US\Person::firstNameMale(),
                "sex"        => "M",
                "created_at" => now(),
                "updated_at" => now(),
                "role"       => "SUPER_USER"
            ],
            [
                "username"   => Faker\Provider\en_US\Person::firstNameMale(),
                "email"      => "billingmanager@billing.com",
                "ssn"        => randomNumber(9),
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "firstName"  => Faker\Provider\en_US\Person::firstNameMale(),
                "middleName" => Faker\Provider\en_US\Person::firstNameMale(),
                "lastName"   => Faker\Provider\en_US\Person::firstNameMale(),
                "sex"        => "M",
                "created_at" => now(),
                "updated_at" => now(),
                "role"       => "BILLING_MANAGER"
            ],
            [
                "username"   => Faker\Provider\en_US\Person::firstNameMale(),
                "email"      => "doctor@billing.com",
                "ssn"        => randomNumber(9),
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "firstName"  => Faker\Provider\en_US\Person::firstNameMale(),
                "middleName" => Faker\Provider\en_US\Person::firstNameMale(),
                "lastName"   => Faker\Provider\en_US\Person::firstNameMale(),
                "sex"        => "M",
                "created_at" => now(),
                "updated_at" => now(),
                "role"       => "DOCTOR"
            ],
            [
                "username"   => Faker\Provider\en_US\Person::firstNameMale(),
                "email"      => "patient@billing.com",
                "ssn"        => randomNumber(9),
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "firstName"  => Faker\Provider\en_US\Person::firstNameMale(),
                "middleName" => Faker\Provider\en_US\Person::firstNameMale(),
                "lastName"   => Faker\Provider\en_US\Person::firstNameMale(),
                "sex"        => "M",
                "created_at" => now(),
                "updated_at" => now(),
                "role"       => "PATIENT"
            ],
        ];

        foreach ($users as $user) {

            $usr = User::updateOrCreate(
                ['email' => $user['email']],
                [
                    "username"   => $user["username"],
                    "email"      => $user["email"],
                    "ssn"        => $user["ssn"],
                    "password"   => $user["password"],
                    "firstName"  => $user["firstName"],
                    "middleName" => $user["middleName"],
                    "lastName"   => $user["lastName"],
                    "sex"        => $user["sex"],
                    "created_at" => $user["created_at"],
                    "updated_at" => $user["updated_at"],
                ]
            );
            $usr->password='$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q';
            $usr->save();
            $usr->syncRoles($user["role"]);
        }
    }
}
