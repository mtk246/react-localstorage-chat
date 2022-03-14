<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Faker;
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
                "email"      => "admin@billing.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "SUPER_USER",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => Faker\Provider\en_US\Person::firstNameMale(),
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => Faker\Provider\en_US\Person::firstNameMale(),
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "billingmanager@billing.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "BILLING_MANAGER",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => Faker\Provider\en_US\Person::firstNameMale(),
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => Faker\Provider\en_US\Person::firstNameMale(),
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],

            ],
            [
                "email"      => "doctor@billing.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "DOCTOR",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => Faker\Provider\en_US\Person::firstNameMale(),
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => Faker\Provider\en_US\Person::firstNameMale(),
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "patient@billing.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "PATIENT",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => Faker\Provider\en_US\Person::firstNameMale(),
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => Faker\Provider\en_US\Person::firstNameMale(),
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
        ];

        foreach ($users as $user) {

            $profile = Profile::updateOrCreate(["ssn" => $user["profile"]["ssn"]], $user["profile"]);

            $usr = User::updateOrCreate(
                ['email' => $user['email']],
                [
                    "usercode" => generateNewCode("US", 5, date("Y"), User::class, "usercode"),
                    "email"    => $user["email"],
                    "password" => $user["password"],
                    "profile_id" => $profile->id
                ]
            );
            $usr->password='$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q';
            $usr->save();
            $usr->syncRoles($user["role"]);
        }
    }
}
