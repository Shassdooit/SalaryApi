<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkTransactionRequest;
use App\Services\CreateWorkTransaction\CreateWorkTransactionDto;
use App\Services\CreateWorkTransaction\CreateWorkTransactionService;
use Illuminate\Http\JsonResponse;

class WorkTransactionController extends Controller
{

    public function __construct(private readonly CreateWorkTransactionService $workTransactionService)
    {
    }

    public function store(StoreWorkTransactionRequest $request): JsonResponse
    {
        $validatedRequest = $request->validated();
        $transactionDto = new CreateWorkTransactionDto(
            $validatedRequest['worker_id'],
            $validatedRequest['hours'],
            $validatedRequest['is_paid'],
        );

        $this->workTransactionService->create($transactionDto);

        return response()->json(status: 201);
    }

}
