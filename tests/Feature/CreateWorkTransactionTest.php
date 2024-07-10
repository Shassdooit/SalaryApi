<?php

namespace Tests\Feature;

use App\Models\Worker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CreateWorkTransactionTest extends TestCase
{
    use RefreshDatabase;


    public function testExample(): void
    {
        $worker = Worker::factory()->create();

        $response = $this->postJson('/api/v1/work-transactions', [
            'worker_id' => $worker->id,
            'hours' => 8,
            'is_paid' => false,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('work_transactions', [
            'worker_id' => $worker->id,
            'hours' => 8,
            'is_paid' => false,
        ]);
    }
}
