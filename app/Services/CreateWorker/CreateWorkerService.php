<?php

namespace App\Services\CreateWorker;

use App\Models\Worker;
use Illuminate\Support\Facades\Hash;

class CreateWorkerService
{
    public function create(CreateWorkerDto $createWorkerDto): void
    {
        Worker::create([
            'email' => $createWorkerDto->email,
            'password' => Hash::make($createWorkerDto->password),
            'hourly_rate' => $createWorkerDto->hourlyRate,
            'payment_type' => $createWorkerDto->paymentType,
            'weekly_salary' => $createWorkerDto->weeklySalary,
        ]);
    }
}
