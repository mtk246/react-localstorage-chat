<?php

declare(strict_types=1);

namespace Database\Factories\Claims;

use App\Models\Claims\Claim;
use App\Models\InsurancePolicy;
use App\Models\PrivateNote;
use App\Models\RefileReason;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
final class DenialRefileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'refile_type' => $this->faker->randomNumber(1),
            'policy_id' => InsurancePolicy::factory(),
            'is_cross_over' => $this->faker->boolean,
            'cross_over_date' => $this->faker->dateTime(),
            'note' => $this->faker->text(20),
            'original_claim_id' => null,
            'refile_reason' => RefileReason::factory(),
            'claim_id' => Claim::factory(),
            'private_note_id' => PrivateNote::factory(),
        ];
    }
}
