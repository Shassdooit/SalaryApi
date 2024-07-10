<?php

namespace App\Services\CreateWorkTransaction;

use App\Models\WorkTransaction;


class CreateWorkTransactionService
{
    public function create(CreateWorkTransactionDto $createWorkTransactionDto): void
    {
        WorkTransaction::create([
            'worker_id' => $createWorkTransactionDto->worker_id,
            'hours' => $createWorkTransactionDto->hours,
            'is_paid' => $createWorkTransactionDto->is_paid,
        ]);
    }
}
