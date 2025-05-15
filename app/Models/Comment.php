<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['installment_plan_id', 'content', 'user_id'];

    // Define the relationship to the InstallmentPlan model
    public function installmentPlan()
    {
        return $this->belongsTo(InstallmentPlan::class);
    }

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}