<?php

namespace Tests\Feature;

use App\Models\Worker;
use App\Models\WorkTransaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnPaidSalariesTest extends TestCase
{

    use RefreshDatabase;

    public function testExample(): void
    {
        $worker = Worker::factory()->create(['hourly_rate' => 300]);
        WorkTransaction::factory()->create([
            'worker_id' => $worker->id,
            'hours' => 5,
            'is_paid' => false,
        ]);

        $response = $this->getJson('/api/v1/unpaid-salaries');

        $response->assertStatus(200)
            ->assertJson([
                ['worker_id' => $worker->id, 'unpaid_amount' => 1500],
            ]);
    }
}
