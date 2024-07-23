<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateWorkerWithFixedSalary extends TestCase
{


    public function testExample(): void
    {
        $response = $this->postJson('/api/v1/workers', [
            'email' => 'fixed@example.com',
            'password' => 'password',
            'payment_type' => 'fixed',
            'weekly_salary' => 1000,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('workers', [
            'email' => 'fixed@example.com',
            'payment_type' => 'fixed',
            'weekly_salary' => 1000,
        ]);
    }
}
