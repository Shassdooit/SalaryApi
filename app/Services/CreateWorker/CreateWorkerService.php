<?php

namespace App\Services\CreateWorker;

use App\Models\Worker;

class CreateWorkerService
{
    public function create(CreateWorkerDto $createWorkerDto): void
    {
        Worker::create([
            'email' => $createWorkerDto->email,
            'password' => bcrypt($createWorkerDto->password),
            'hourly_rate' => $createWorkerDto->hourlyRate,
        ]);
    }
}
