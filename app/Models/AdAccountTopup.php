<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdAccountTopup extends Model
{
    use HasFactory;

    /**
     * Allow mass assignment
     */
    protected $fillable = [
        'ad_account_id',
        'date',
        'amount',
        'currency',
        'notes',
    ];

    /**
     * Link back to the AdAccount
     */
    public function account()
    {
        return $this->belongsTo(AdAccount::class, 'ad_account_id');
    }
}
