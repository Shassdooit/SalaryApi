<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\PaymentService\PaymentService;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    public function __construct(
        private readonly PaymentService $paymentService
    ) {
    }

    public function unpaidSalaries(): JsonResponse
    {
        $unpaidSalaries = $this->paymentService->getUnpaidSalaries();

        return response()->json($unpaidSalaries);
    }

    public function paySalaries(): JsonResponse
    {
        $this->paymentService->paySalaries();

        return response()->json();
    }
}
