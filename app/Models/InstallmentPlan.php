<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_amount',
        'monthly_installment',
        'duration_months',
        'amount_paid',
        'remaining_balance',
        'start_date',
        'rescheduled_date',
    ];

    // Cast start_date to a date instance (Carbon)
    protected $casts = [
        'start_date' => 'date',
    ];

    /**
     * Define the relationship with InstallmentPayment model
     */
    public function payments()
    {
        return $this->hasMany(InstallmentPayment::class);
    }

    /**
     * Calculate the remaining balance for the installment plan
     */
    public function calculateRemainingBalance()
    {
        return $this->total_amount - $this->amount_paid;
    }

    /**
     * Calculate the total penalties for this installment plan
     */
    public function totalPenalties()
{
    return $this->payments->sum('penalty_amount'); // Sum up all penalty amounts
}
}