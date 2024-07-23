<?php

namespace App\Services\PaymentService;

use App\Models\WorkTransaction;
use Illuminate\Support\Facades\DB;

class PaySalariesService
{
    public function paySalaries(): void
    {
        DB::transaction(function () {
            $unpaidTransactions = WorkTransaction::where('is_paid', false)->get();

            foreach ($unpaidTransactions as $transaction) {
                $worker = $transaction->worker;

                if ($worker->isFixed()) {
                    $weeklyTransactions = WorkTransaction::where('worker_id', $worker->id)
                        ->where('week_id', $transaction->week_id)
                        ->where('is_paid', false)
                        ->get();

                    foreach ($weeklyTransactions as $weeklyTransaction) {
                        $weeklyTransaction->is_paid = true;
                        $weeklyTransaction->save();
                    }
                } else {
                    $transaction->is_paid = true;
                    $transaction->save();
                }
            }
        });
    }
}
