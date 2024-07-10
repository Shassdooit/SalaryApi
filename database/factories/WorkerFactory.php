<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class WorkerFactory extends Factory
{

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'hourly_rate' => $this->faker->numberBetween(10, 50),
        ];
    }
}
