<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PermanentContactPoint>
 */
class PermanentContactPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'entity_name' => $this->faker->company(),
            'permanent_contact_point_name' => $this->faker->name(),
            'main_email_address' => $this->faker->companyEmail(),
            'secondary_email_address' => $this->faker->email(),
            'main_landline_phone_number' => $this->faker->phoneNumber(),
            'secondary_landline_phone_number' => $this->faker->phoneNumber(),
            'main_mobile_phone_number' => $this->faker->phoneNumber(),
            'secondary_mobile_phone_number' => $this->faker->phoneNumber(),
            'other_alternative_contacts' => $this->faker->address(),
        ];
    }
}
