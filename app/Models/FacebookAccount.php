<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookAccount extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'account_id', 'current_balance'];

    // Added withDefault() for consistency
    public function funds()
    {
        return $this->hasMany(Fund::class)->withDefault([
            'amount' => 0,
            'currency' => 'USD'
        ]);
    }

    // Updated relationship to match Client model
    public function clients()
    {
        return $this->hasMany(Client::class)->withDefault([
            'name' => 'No Linked Client',
            'email' => ''
        ]);
    }

    // Bonus: Accessor for formatted balance
    public function getFormattedBalanceAttribute()
    {
        return '$' . number_format($this->current_balance, 2);
    }

    // Bonus: Scope for active accounts
    public function scopeActive($query)
    {
        return $query->where('current_balance', '>', 0);
    }
}