<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = ['facebook_account_id', 'amount', 'tax_inclusive', 'tax_exclusive', 'tax'];

    public function facebookAccount()
    {
        return $this->belongsTo(FacebookAccount::class);
    }
}