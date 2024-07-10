<?php

use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\WorkerController;
use App\Http\Controllers\Api\V1\WorkTransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::apiResource('workers', WorkerController::class);
    Route::apiResource('work-transactions', WorkTransactionController::class);

    Route::get('unpaid-salaries', [PaymentController::class, 'unpaidSalaries']);
    Route::post('pay-salaries', [PaymentController::class, 'paySalaries']);
});

