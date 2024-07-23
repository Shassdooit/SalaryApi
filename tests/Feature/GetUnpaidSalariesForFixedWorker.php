<?php

namespace Tests\Feature;

use App\Models\Worker;
use App\Models\WorkTransaction;
use Tests\TestCase;

class GetUnpaidSalariesForFixedWorker extends TestCase
{
    public function testExample(): void
    {
        $worker = Worker::factory()->create([
            'payment_type' => 'fixed',
            'weekly_salary' => 1000,
        ]);
        WorkTransaction::factory()->create([
            'worker_id' => $worker->id,
            'week_id' => 1,
            'hours' => 0,
            'is_paid' => false,
        ]);

        $response = $this->getJson('/api/v1/unpaid-salaries');

        $response->assertStatus(200)
            ->assertJson([
                ['worker_id' => $worker->id, 'unpaid_amount' => 1000],
            ]);
    }
}
