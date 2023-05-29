<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;
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
            'status' => 1
        ];
    }
    /**
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withProfile()
    {
        return $this->state(function (array $attributes) {
            return [
                'profile_id' => Profile::factory()->create()->id
            ];
        });
    }
}
