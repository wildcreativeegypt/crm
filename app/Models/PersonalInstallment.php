<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInstallment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payee',
        'installment_amount',
        'currency',
        'due_date',
        'frequency',
        'paid',
    ];

    /**
     * (Optional) Link to the User who created it
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
