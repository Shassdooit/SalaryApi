<?php

namespace App\Services\PaymentService;

use App\Models\WorkTransaction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function getUnpaidSalaries(): Collection
    {
        return DB::table('work_transactions')
            ->join('workers', 'work_transactions.worker_id', '=', 'workers.id')
            ->select(
                'work_transactions.worker_id',
                DB::raw(
                    'CASE
                            WHEN workers.payment_type = "hourly" THEN SUM(work_transactions.hours * workers.hourly_rate)
                            WHEN workers.payment_type = "fixed" THEN workers.weekly_salary * COUNT(DISTINCT work_transactions.week_id)
                         END as unpaid_amount'
                )
            )
            ->where('work_transactions.is_paid', false)
            ->groupBy('work_transactions.worker_id')
            ->get();
    }

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
