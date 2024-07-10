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
                DB::raw('SUM(work_transactions.hours * workers.hourly_rate) as unpaid_amount')
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
                $transaction->is_paid = true;
                $transaction->save();
            }
        });
    }
}
