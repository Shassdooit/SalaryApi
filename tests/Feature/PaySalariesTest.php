<?php

namespace Tests\Feature;

use App\Models\Worker;
use App\Models\WorkTransaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaySalariesTest extends TestCase
{
    use RefreshDatabase;

    public function testExample(): void
    {
        $worker = Worker::factory()->create(['hourly_rate' => 20]);
        WorkTransaction::factory()->create([
            'worker_id' => $worker->id,
            'hours' => 5,
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
