<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdExpense;
use App\Models\Payment;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get all ad expenses for this client.
     */
    public function adExpenses()
    {
        return $this->hasMany(AdExpense::class);
    }

    /**
     * Get all payments for this client.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
