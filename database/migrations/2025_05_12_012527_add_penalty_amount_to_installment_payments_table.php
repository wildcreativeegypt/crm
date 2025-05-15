<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installment_payments', function (Blueprint $table) {
            $table->decimal('penalty_amount', 10, 2)->nullable()->after('amount'); // Add a nullable 'penalty_amount' column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installment_payments', function (Blueprint $table) {
            $table->dropColumn('penalty_amount'); // Rollback the 'penalty_amount' column
        });
    }
};