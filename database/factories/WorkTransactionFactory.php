<?php

namespace Database\Factories;

use App\Models\Worker;
use App\Models\WorkTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;


class WorkTransactionFactory extends Factory
{
    protected $model = WorkTransaction::class;

    public function definition(): array
    {
        return [
            'worker_id' => Worker::factory(),
            'hours' => $this->faker->numberBetween(1, 10),
            'is_paid' => false,
        ];
    }
}
