<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'category',
        'amount',
        'currency',
        'notes',
    ];

    /**
     * (Optional) Link to the User who recorded it
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
