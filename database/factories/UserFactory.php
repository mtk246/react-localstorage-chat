<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\User\UserType;
use App\Models\BillingCompany;
use App\Models\BillingCompany\Membership;
use App\Models\BillingCompanyHealthProfessional;
use App\Models\Patient\Membership as PatientMembership;
use App\Models\Profile;
use App\Models\User;
use App\Roles\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;
    public $type = UserType::BILLING;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('helloworld'),
            'status' => 1,
            'type' => UserType::BILLING->value,
        ];
    }

    public function withProfile(Profile $profile = null): self
    {
        return $this->state(function (array $attributes) use ($profile) {
            return [
                'profile_id' => $profile?->id ?? Profile::factory()->create()->id,
            ];
        });
    }

    public function hasType(UserType $type, BillingCompany $billingCompany = null): self
    {
        return $this->state(function (array $attributes) use ($type, $billingCompany) {
            return [
                'type' => $type->value,
                'billing_company_id' => $billingCompany ? $billingCompany->id : BillingCompany::factory(),
            ];
        });
    }

    public function hasBillingCompany(BillingCompany $billingCompany = null): self
    {
        return $this->state(function (array $attributes) use ($billingCompany) {
            return [
                'billingCompanies' => [
                    $billingCompany?->id ?? BillingCompany::factory()->create()->id,
                ],
            ];
        });
    }

    public function whithRole(Role $role = null): self
    {
        return $this->afterCreating(function (User $user) use ($role) {
            $userTypeValue = $user->type->value ?? UserType::BILLING->value;
            match ($userTypeValue) {
                UserType::BILLING->value => $this->setBillingRole($user, $role),
                UserType::ADMIN->value => $this->setAdminRole($user, $role),
                UserType::DOCTOR->value => $this->setDoctorRole($user, $role),
                UserType::PATIENT->value => $this->setPatientRole($user, $role),
                default => throw new \InvalidArgumentException("Unhandled user type: $userTypeValue"),
            };
        });
    }

    private function setBillingRole(User $user, Role $role = null): void
    {
        $user
            ->billingCompanies()
            ->wherePivot('billing_company_id', $user->billing_company_id)
            ->first()
            ?->membership
            ->roles()
            ->syncWithPivotValues(
                $role->id ?? Role::factory()->create()->id,
                ['rollable_type' => Membership::class],
                false
            );
    }

    private function setAdminRole(User $user, Role $role = null): void
    {
        $role = $role ?: Role::factory()->create();

        $user->roles()->sync([$role->id => ['rollable_type' => User::class]], false);
    }

    private function setDoctorRole(User $user, Role $role = null): void
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

    private function setPatientRole(User $user, Role $role = null): void
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
                ['rollable_type' => PatientMembership::class],
                false
            );
    }

    public function withBillingCompany(BillingCompany $billingCompany = null): self
    {
        return $this->state(function (array $attributes) use ($billingCompany) {
            return [
                'billing_company_id' => $billingCompany->id ?? BillingCompany::factory(),
            ];
        });
    }
}
