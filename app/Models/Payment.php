<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'date',
        'amount',
        'company_tax_rate',
        'company_tax_amount',
        'method',
        'client_id',          // ensure this is fillable if you plan to mass-assign
    ];

    /**
     * Payment belongs to a Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Calculate net received (amount minus tax).
     */
    public function getNetReceivedAttribute()
    {
        return $this->amount - ($this->company_tax_amount ?? 0);
    }
}
