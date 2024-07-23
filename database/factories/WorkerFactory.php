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
            'payment_type' => $this->faker->randomElement(['hourly', 'fixed']),
            'hourly_rate' => $this->faker->numberBetween(10, 50),
            'weekly_salary' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
