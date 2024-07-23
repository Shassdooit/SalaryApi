<?php

namespace Tests\Feature;

use App\Models\Worker;
use App\Models\WorkTransaction;
use Tests\TestCase;

class PaySalariesForFixedWorker extends TestCase
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

        $response = $this->postJson('/api/v1/pay-salaries');

        $response->assertStatus(200);
        $this->assertDatabaseHas('work_transactions', [
            'worker_id' => $worker->id,
            'is_paid' => true,
        ]);
    }
}
