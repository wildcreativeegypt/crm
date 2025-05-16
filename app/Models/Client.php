<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'facebook_account_id'];

    // Fixed relationship with null protection
    public function facebookAccount()
    {
        return $this->belongsTo(FacebookAccount::class)->withDefault([
            'name' => 'No Facebook Account',  // Default values
            'id' => null                     // Prevents "property of non-object" errors
        ]);
    }

    // Bonus: Add this scope for easy querying of clients with/without FB accounts
    public function scopeWithFacebook($query)
    {
        return $query->whereNotNull('facebook_account_id');
    }
}