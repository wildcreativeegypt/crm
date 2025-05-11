<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdAccount extends Model
{
    use HasFactory;

    /**
     * Allow mass assignment on these fields
     */
    protected $fillable = [
        'name',
        'currency',
    ];

    /**
     * All top-ups on this ad account
     */
    public function topups()
    {
        return $this->hasMany(AdAccountTopup::class);
    }

    /**
     * All expenses charged to this ad account
     */
    public function expenses()
    {
        return $this->hasMany(AdExpense::class);
    }

    /**
     * Compute the current balance: total top-ups minus (amount + fee) of expenses
     */
    public function getBalanceAttribute()
    {
        $totalTopups   = $this->topups()->sum('amount');
        $totalExpenses = $this->expenses()->sum(DB::raw('amount + credit_card_fee_amount'));
        return $totalTopups - $totalExpenses;
    }
}
