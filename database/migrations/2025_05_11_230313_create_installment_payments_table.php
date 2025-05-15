<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentPaymentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('installment_payments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('installment_plan_id')->constrained()->onDelete('cascade'); // Foreign key to installment_plans
            $table->decimal('amount', 10, 2); // Payment amount
            $table->date('payment_date'); // Date of the payment
            $table->string('status')->default('Paid'); // Status of the payment (e.g., Paid, Late)
            $table->timestamps(); // Laravel's created_at and updated_at columns
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('installment_payments');
    }
}