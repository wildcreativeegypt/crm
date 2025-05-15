<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'facebook_account_id'];

    public function facebookAccount()
    {
        return $this->belongsTo(FacebookAccount::class);
    }
}