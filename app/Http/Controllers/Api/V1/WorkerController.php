<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkerRequest;
use App\Services\CreateWorker\CreateWorkerDto;
use App\Services\CreateWorker\CreateWorkerService;
use Illuminate\Http\JsonResponse;

class WorkerController extends Controller
{
    public function __construct(private readonly CreateWorkerService $workerService)
    {
    }

    public function store(StoreWorkerRequest $request): JsonResponse
    {
        $validatedRequest = $request->validated();
        $workerDto = new CreateWorkerDto(
            $validatedRequest['email'],
            $validatedRequest['password'],
            $validatedRequest['hourly_rate']
        );

        $this->workerService->create($workerDto);

        return response()->json(status: 201);
    }
}
