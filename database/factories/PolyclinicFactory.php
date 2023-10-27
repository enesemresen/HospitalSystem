<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Hospital;


class PolyclinicFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'personal_id' => User::factory()->create(['role' => 'personal'])->id,
            'hospital_id' => Hospital::factory()->create()->id,
        ];
    }
}
