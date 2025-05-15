<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentPayment extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = [
        'installment_plan_id',
        'amount',
		'penalty_amount',
        'payment_date',
        'status',
    ];

    // Relationship with InstallmentPlan
    public function plan()
{
    return $this->belongsTo(InstallmentPlan::class, 'installment_plan_id');
}
}