<?php

namespace Tests\Feature;

use App\Models\Worker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateWorkerTest extends TestCase
{

    use RefreshDatabase;

    public function testExample(): void
    {
        $response = $this->postJson('/api/v1/workers', [
            'email' => 'test@example.com',
            'password' => 'password',
            'hourly_rate' => 300,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('workers', [
            'email' => 'test@example.com',
        ]);
    }
}
