<?php

namespace App\Services\CreateWorker;

readonly class CreateWorkerDto
{
    public function __construct(
        public string $email,
        public string $password,
        public ?int $hourlyRate,
        public string $paymentType,
        public ?int $weeklySalary,
    ) {
    }
}
