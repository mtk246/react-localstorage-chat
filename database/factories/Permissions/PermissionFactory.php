<?php

declare(strict_types=1);

namespace Database\Factories\Permissions;

use App\Models\BillingCompany;
use App\Models\BillingCompany\MembershipRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permissions\Permission>
 */
final class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'module' => $this->faker->word(),
            'permission' => $this->faker->randomElements(['create', 'read', 'update', 'delete'], 2),
            'billing_company_id' => BillingCompany::factory(),
        ];
    }

    public function forRole(?MembershipRole $role = null): self
    {
        return $this->state(function (array $attributes) use ($role) {
            return [
                'permissioned_type' => 'role',
                'permissioned_id' => is_null($role)
                    ? MembershipRole::factory()
                    : $role->id,
            ];
        });
    }

    public function forUser(?User $user = null): self
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'permissioned_type' => 'role',
                'permissioned_id' => is_null($user)
                    ? User::factory()
                    : $user->id,
            ];
        });
    }
}
