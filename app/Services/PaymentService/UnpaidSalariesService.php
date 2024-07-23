<?php

namespace App\Services\PaymentService;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UnpaidSalariesService
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
}
