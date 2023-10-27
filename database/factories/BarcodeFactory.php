<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;


class BarcodeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'value' => $this->faker->randomFloat,
            'appointment_id' => Appointment::factory()->create()->id,
        ];
    }
}
