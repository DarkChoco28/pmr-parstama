<?php

namespace Database\Factories;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'nickname' => fake()->firstName(),
            'gender' => fake()->randomElement(['L', 'P']),
            'birth_place' => fake()->city(),
            'birth_date' => fake()->dateTimeBetween('-30 years', '-15 years')->format('Y-m-d'),
            'religion' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'province' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'whatsapp' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'class' => fake()->randomElement(['10', '11', '12']),
            'major' => fake()->randomElement(['IPA', 'IPS']),
            'blood_type' => fake()->randomElement(['A', 'B', 'AB', 'O']) . fake()->randomElement(['+', '-']),
            'medical_history' => fake()->randomElement(['None', 'Alergi', 'Asma']),
            'organization_experience' => fake()->sentence(),
            'motivation' => fake()->paragraph(3),
            'status' => fake()->randomElement([Registration::STATUS_PENDING, Registration::STATUS_ACCEPTED, Registration::STATUS_REJECTED]),
        ];
    }

    /**
     * Indicate that the registration is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Registration::STATUS_PENDING,
        ]);
    }

    /**
     * Indicate that the registration is accepted.
     */
    public function accepted(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Registration::STATUS_ACCEPTED,
        ]);
    }

    /**
     * Indicate that the registration is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Registration::STATUS_REJECTED,
        ]);
    }
}
