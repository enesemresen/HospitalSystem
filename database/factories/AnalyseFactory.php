<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


class AnalyseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['blood', 'urine', 'x-ray']),
            'result' => $this->faker->text(255),
            'created_id' => User::factory()->create(['role' => 'personal'])->id,
            'patient_id' => User::factory()->create(['role' => 'patient'])->id,
            'personal_id' => User::factory()->create(['role' => 'doctor'])->id,
        ];
    }
}
