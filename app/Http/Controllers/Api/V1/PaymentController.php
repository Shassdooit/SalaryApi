<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\PaymentService\UnpaidSalariesService;
use App\Services\PaymentService\PaySalariesService;
use Illuminate\Http\JsonResponse;


class PaymentController extends Controller
{
    public function __construct(
        private readonly PaySalariesService $paySalariesService,
        private readonly UnpaidSalariesService $unpaidSalariesService
    ) {
    }

    public function unpaidSalaries(): JsonResponse
    {
        $unpaidSalaries = $this->unpaidSalariesService->getUnpaidSalaries();

        return response()->json($unpaidSalaries);
    }

    public function paySalaries(): JsonResponse
    {
        $this->paySalariesService->paySalaries();

        return response()->json();
    }
}
