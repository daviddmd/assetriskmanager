<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SecurityOfficer>
 */
class SecurityOfficerFactory extends Factory
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
            'name' => $this->faker->name(),
            'role' => "Security Officer",
            'email_address' => $this->faker->companyEmail(),
            'landline_phone_number' => $this->faker->phoneNumber(),
            'mobile_phone_number' => $this->faker->phoneNumber(),
        ];
    }
}
