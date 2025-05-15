<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookAccount extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'account_id', 'current_balance'];

    public function funds()
    {
        return $this->hasMany(Fund::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}