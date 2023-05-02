<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use App\Roles\Models\Role;
use Faker;
use Illuminate\Database\Seeder;

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
                'email' => 'begentohealthcare@gmail.com',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'billingmanager@billing.com',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'billingmanager',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'salcantara3@gmail.com',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'billingmanager',
                'profile' => [
                                    'ssn' => '176423970',
                                    'first_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'healthprofessional@billing.com',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'healthprofessional',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'patient@billing.com',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'patient',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'kp@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Kevin',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Perez',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'rs@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Rosana',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Sanchez',
                                    'sex' => 'F',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'aq@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Alfredo',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Quintero',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'anp@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Andrea',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Perez',
                                    'sex' => 'F',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'ec@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Edgar',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Carrizalez',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'vh@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Valentin',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Herrera',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'mb@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Maikel',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Bello',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'js@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Juan',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Schloter',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'mp@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Moises',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Perez',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'hp@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Henry',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Paredes',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'ma@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Alonso',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Monser',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'mr@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Miguel',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Renault',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'sa@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Sara',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Alcántara',
                                    'sex' => 'F',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'jg@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Jose',
                                    'middle_name' => 'Gabriel',
                                    'last_name' => 'Guillen',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'bq@ciph3r.co',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Brenlys',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Quintero',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
            [
                'email' => 'admin@sam.com',
                'password' => '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q',
                'role' => 'superuser',
                'profile' => [
                                    'ssn' => randomNumber(9),
                                    'first_name' => 'Sr.',
                                    'middle_name' => Faker\Provider\en_US\Person::firstNameMale(),
                                    'last_name' => 'Sam',
                                    'sex' => 'M',
                                    'date_of_birth' => '1990-04-01',
                                ],
            ],
        ];

        foreach ($users as $user) {
            $profile = Profile::updateOrCreate(['ssn' => $user['profile']['ssn']], $user['profile']);

            $usr = User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'usercode' => generateNewCode('US', 5, date('Y'), User::class, 'usercode'),
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'profile_id' => $profile->id,
                ]
            );
            $usr->password = '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q';
            $usr->save();

            $usr->detachAllPermissions();
            $usr->detachAllRoles();

            // $usr->detachAllPermissions();
            // $usr->detachAllRoles();

            $role = Role::where('slug', $user['role'])->first();
            if (isset($role)) {
                $usr->attachRole($role);
                $permissions = $role->permissions;
                foreach ($permissions as $perm) {
                    $usr->attachPermission($perm);
                }
            }
        }
    }
}
