<?php

namespace Tests\Feature;

use App\Models\Worker;
use App\Models\WorkTransaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnPaidSalariesTest extends TestCase
{

    use RefreshDatabase;

    public function testExample()
    {
        $worker = Worker::factory()->create([
            'payment_type' => 'fixed',
            'weekly_salary' => 500,
        ]);

        WorkTransaction::factory()->create([
            'worker_id' => $worker->id,
            'hours' => 10,
            'is_paid' => 0,
            'week_id' => 1,
        ]);

        WorkTransaction::factory()->create([
            'worker_id' => $worker->id,
            'hours' => 5,
            'is_paid' => 0,
            'week_id' => 2,
        ]);

        $response = $this->getJson('/api/v1/unpaid-salaries');

        $response->assertStatus(200)
            ->assertJson([
                ['worker_id' => $worker->id, 'unpaid_amount' => 1000],
            ]);
    }
}
