<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Client;

class AdExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_account_id',
        'date',
        'amount',
        'currency',
        'credit_card_fee_rate',
        'credit_card_fee_amount',
        'receipt_path',
        'reimbursed',
        'invoiced',
        'notes',
        'client_id',          // ensure this is fillable if you plan to mass-assign
    ];

    /**
     * Expense belongs to an AdAccount
     */
    public function account()
    {
        return $this->belongsTo(AdAccount::class, 'ad_account_id');
    }

    /**
     * Expense belongs to a Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Automatically calculate fee on creation
     */
    protected static function booted()
    {
        static::creating(function ($expense) {
            if (is_null($expense->credit_card_fee_rate)) {
                $expense->credit_card_fee_rate = config('crm.credit_card_fee_rate', 0.05);
            }
            $expense->credit_card_fee_amount = $expense->amount * $expense->credit_card_fee_rate;
        });
    }

    /**
     * Total cost = amount + fee
     */
    public function getTotalCostAttribute()
    {
        return $this->amount + $this->credit_card_fee_amount;
    }
}
