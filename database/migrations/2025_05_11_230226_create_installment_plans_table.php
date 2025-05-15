<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentPlansTable extends Migration
{
    public function up(): void
    {
        Schema::create('installment_plans', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->decimal('total_amount', 10, 2);
    $table->decimal('monthly_installment', 10, 2);
    $table->integer('duration_months');
    $table->decimal('amount_paid', 10, 2)->default(0);
    $table->decimal('remaining_balance', 10, 2);
    $table->date('start_date'); // Ensure this is of type 'date'
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('installment_plans');
    }
}