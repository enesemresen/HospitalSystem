<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


class UserIdentityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tc_no' => $this->faker->unique()->numerify('##############'), 
            'mother_name' => $this->faker->firstName,
            'father_name' => $this->faker->lastName,
            'serial_no' => $this->faker->unique()->numerify('#########'),
            'birthday' => $this->faker->date,
            'birthplace' => $this->faker->city,
            'user_id' => User::factory()->create()->id,
            'insurance_number' => $this->faker->unique()->numerify('##########'), 
        ];
    }
}