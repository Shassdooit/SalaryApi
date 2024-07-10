<?php

namespace App\Services\CreateWorkTransaction;

readonly class CreateWorkTransactionDto
{
    public function __construct(
        public int $worker_id,
        public int $hours,
        public bool $is_paid
    ) {
    }
}
