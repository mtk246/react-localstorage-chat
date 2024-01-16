<?php

declare(strict_types=1);

namespace Database\Factories\Claims;

use App\Models\Claims\Claim;
use App\Models\InsurancePolicy;
use App\Models\PrivateNote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
final class DenialTrackingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'interface_type' => 1,
            'is_reprocess_claim' => boolval(rand(0, 1)),
            'is_contact_to_patient' => boolval(rand(0, 1)),
            'contact_through' => $this->faker->randomElement(['Phone', 'Email', 'Text', 'Fax', 'Email and Text', 'Phone and Text']),
            'claim_number' => $this->faker->randomNumber(1),
            'rep_name' => $this->faker->name,
            'ref_number' => $this->faker->randomNumber(3),
            'claim_status' => $this->faker->randomNumber(1),
            'claim_sub_status' => $this->faker->randomNumber(1),
            'tracking_date' => $this->faker->dateTime(),
            'resolution_time' => $this->faker->dateTime(),
            'past_due_date' => $this->faker->dateTime(),
            'follow_up' => $this->faker->dateTime(),
            'department_responsible' => $this->faker->randomElement(['Medicare', 'Medicaid', 'Other']),
            'policy_responsible' => $this->faker->randomElement(['Self', 'Spouse', 'Child', 'Other']),
            'response_details' => $this->faker->words(3, true),
            'private_note_id' => PrivateNote::factory(),
            'claim_id' => Claim::factory(),
            'policy_id' => InsurancePolicy::factory(),
        ];
    }
}
