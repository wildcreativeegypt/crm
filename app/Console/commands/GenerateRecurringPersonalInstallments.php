<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PersonalInstallment;
use Carbon\Carbon;

class GenerateRecurringPersonalInstallments extends Command
{
    protected $signature = 'personal-installments:generate-recurring';
    protected $description = 'Generate recurring personal installments';

    public function handle()
    {
        $installments = PersonalInstallment::where('is_recurring', true)
            ->where('due_date', '<=', Carbon::now())
            ->get();

        foreach ($installments as $installment) {
            $nextDueDate = $installment->calculateNextDueDate();

            // Skip if next due date exceeds recurring end date
            if ($installment->recurring_end_date && $nextDueDate > Carbon::parse($installment->recurring_end_date)) {
                continue;
            }

            // Create new installment
            $installment->replicate()->fill([
                'due_date' => $nextDueDate,
                'is_recurring' => false, // Mark as non-recurring after generation
            ])->save();
        }

        $this->info('Recurring personal installments generated successfully.');
    }
}