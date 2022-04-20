<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Roles\Models\Role;
use App\Roles\Models\Permission;
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
                "role"       => "superuser",
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
                "role"       => "billingmanager",
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
                "email"      => "healthprofessional@billing.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "healthprofessional",
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
                "role"       => "patient",
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
                "email"      => "admin@kevin.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "superuser",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => "Kevin",
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => "Perez",
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "admin@rosana.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "superuser",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => "Rosana",
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => "Sanchez",
                                    "sex"           => "F",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "admin@alfredo.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "superuser",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => "Alfredo",
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => "Quintero",
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "admin@alejandro.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "superuser",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => "Alejandro",
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => "Perez",
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "admin@andrea.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "superuser",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => "Andrea",
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => "Perez",
                                    "sex"           => "F",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "admin@edgar.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "superuser",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => "Edgar",
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => "Carrizalez",
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "admin@jesus.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "superuser",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => "Jesus",
                                    "middle_name"   => "Abrahan",
                                    "last_name"     => "Peña",
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "admin@juan.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "superuser",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => "Juan",
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => "Barreto",
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "admin@moises.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "superuser",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => "Moises",
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => "Perez",
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "admin@henry.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "superuser",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => "Henry",
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => "Paredes",
                                    "sex"           => "M",
                                    "date_of_birth" => "1990-04-01",
                                ],
            ],
            [
                "email"      => "admin@sam.com",
                "password"   => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                "role"       => "superuser",
                "profile"    => [
                                    "ssn"           => randomNumber(9),
                                    "first_name"    => "Sr.",
                                    "middle_name"   => Faker\Provider\en_US\Person::firstNameMale(),
                                    "last_name"     => "Sam",
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
            //$usr->syncRoles($user["role"]);
            
            //$usr->detachAllPermissions();
            $usr->detachAllRoles();

            $role = Role::where('slug', $user['role'])->first();
            $usr->attachRole($role);

            /*$permissions = Permission::whereHas('roles', function ($query) use ($role) {
                $query->where('role_id', $role->id);
            })->get();
            foreach ($permissions as $permission) {
                $usr->attachPermission($permission->id);
            }*/
        }
    }
}
