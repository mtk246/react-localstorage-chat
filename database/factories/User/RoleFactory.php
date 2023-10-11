<?php

declare(strict_types=1);

namespace Database\Factories\User;

use App\Models\Permissions\Permission;
use App\Models\User\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User\Role>
 */
final class RoleFactory extends Factory
{
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->sentence(),
            'level' => $this->faker->numberBetween(1, 7),
        ];
    }

    public function withBillingCompany(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'billing_company_id' => \App\Models\BillingCompany::factory(),
            ];
        });
    }

    public function withPermissions(): self
    {
        return $this->afterCreating(function (Role $role) {
            Permission::factory(3, ['billing_company_id' => $role->billing_company_id])
                ->forRole($role)
                ->create();
        });
    }
}
