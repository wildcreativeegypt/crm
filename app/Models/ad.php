<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'facebook_account_id',
        'page_name',
        'spend_amount',
        'tax_rate',
        'total_cost',
        'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function facebookAccount()
    {
        return $this->belongsTo(FacebookAccount::class);
    }
}