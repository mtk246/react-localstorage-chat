<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\User\UserType;
use App\Models\BillingCompany;
use App\Models\BillingCompany\Membership as BillingMembership;
use App\Models\BillingCompanyHealthProfessional;
use App\Models\Patient\Membership as PatienMembership;
use App\Models\Profile;
use App\Models\User;
use App\Models\User\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(json_decode(\File::get('database/data/users.json')))
            ->map(function (object $user) {
                $user->type = UserType::from($user->type ?? 1)->value;
                $user->profile = (array) ($user->profile ?? []);
                $user->billingCompanies = (array) ($user->billingCompanies ?? []);

                return (array) $user;
            })
            ->chunk(1000)
        ->each(function (Collection $chunk) {
            Profile::upsert($chunk->pluck('profile')->toArray(), ['ssn']);

            $profiles = Profile::query()->whereIn('ssn', $chunk->pluck('profile.ssn')->toArray())->get(['id', 'ssn']);

            $users = $chunk->map(function (array $userData) use ($profiles) {
                return [
                    'email' => $userData['email'],
                    'password' => $userData['password'],
                    'type' => $userData['type'],
                    'profile_id' => $profiles->where('ssn', $userData['profile']['ssn'])->first()->id,
                    'billing_company_id' => BillingCompany::query()->where('abbreviation', $userData['billingCompany'] ?? null)->first()->id ?? null,
                ];
            });

            User::upsert($users->toArray(), ['email']);

            User::query()->whereIn('email', $users->pluck('email')->toArray())->get(['id', 'email', 'billing_company_id', 'type'])->each(function (User $user) use ($chunk) {
                $chunk->where('email', $user->email)->each(function (array $userData) use ($user) {
                    if ($user->billing_company_id) {
                        $user->billingCompanies()->syncWithoutDetaching($user->billing_company_id);
                    }

                    $role = Role::query()
                        ->where('slug', $userData['role'])
                        ->where('billing_company_id', $user->billing_company_id)
                        ->firstOrFail();

                    match ($user->type->value) {
                        UserType::BILLING->value => $this->setBillingRole($user, $role),
                        UserType::ADMIN->value => $this->setAdminRole($user, $role),
                        UserType::DOCTOR->value => $this->setDoctorRole($user, $role),
                        UserType::PATIENT->value => $this->setPatientRole($user, $role),
                    };
                });
            });
        });
    }

    private function setBillingRole(User $user, ?Role $role = null): void
    {
        $user
            ->billingCompanies()
            ->wherePivot('billing_company_id', $user->billing_company_id)
            ->first()
            ?->membership
            ->roles()
            ->syncWithPivotValues(
                $role->id ?? Role::factory()->create()->id,
                ['rollable_type' => BillingMembership::class],
                false
            );
    }

    private function setAdminRole(User $user, ?Role $role = null): void
    {
        $user->roles()->syncWithPivotValues(
            $role->id ?? Role::factory()->create()->id,
            ['rollable_type' => User::class],
            false
        );
    }

    private function setDoctorRole(User $user, ?Role $role = null): void
    {
        $user
            ->healthProfessional()
            ->billingCompanies()
            ->wherePivot('billing_company_id', $user->billing_company_id)
            ->first()
            ?->membership
            ->roles()
            ->syncWithPivotValues(
                $role->id ?? Role::factory()->create()->id,
                ['rollable_type' => BillingCompanyHealthProfessional::class],
                false
            );
    }

    private function setPatientRole(User $user, ?Role $role = null): void
    {
        $user
            ->patient()
            ->billingCompanies()
            ->wherePivot('billing_company_id', $user->billing_company_id)
            ->first()
            ?->membership
            ->roles()
            ->syncWithPivotValues(
                $role->id ?? Role::factory()->create()->id,
                ['rollable_type' => PatienMembership::class],
                false
            );
    }
}
