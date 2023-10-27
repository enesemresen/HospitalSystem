<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


class AppointmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'patient_id' => User::factory()->create(['role' => 'patient'])->id,
            'personal_id' => User::factory()->create(['role' => 'doctor'])->id,
        ];
    }
}
