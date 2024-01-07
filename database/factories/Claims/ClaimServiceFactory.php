<?php

declare(strict_types=1);

namespace Database\Factories\Claims;

use App\Models\Claims\Claim;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Claims\ClaimService>
 */
final class ClaimServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'non_covered_charges' => $this->faker->text,
            'from' => Carbon::now(),
            'to' => Carbon::now()->addDays(30),
        ];
    }

    private function withClaim(): self
    {
        return $this->state(fn (array $attributes) => [
            'claim_id' => Claim::factory(),
        ]);
    }
}
