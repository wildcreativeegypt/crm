<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PersonalInstallment extends Model
{
    protected $fillable = [
        'payee',
        'installment_amount',
        'due_date',
        'frequency',
        'is_recurring',
        'recurring_interval',
        'recurring_end_date',
    ];

    // Helper: Check if installment is recurring
    public function isRecurring()
    {
        return $this->is_recurring;
    }

    // Generate next due date based on recurring interval
    public function calculateNextDueDate()
    {
        return match ($this->recurring_interval) {
            'weekly' => Carbon::parse($this->due_date)->addWeek(),
            'monthly' => Carbon::parse($this->due_date)->addMonth(),
            default => null,
        };
    }
}