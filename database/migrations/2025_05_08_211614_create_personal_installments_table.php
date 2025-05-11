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
        Schema::create('personal_installments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('payee');               // e.g. Bank, Supplier
            $table->decimal('installment_amount', 15, 2);
            $table->string('currency', 3)->default('EGP');
            $table->date('due_date');
            $table->enum('frequency', ['weekly','monthly','quarterly','custom']);
            $table->boolean('paid')->default(false);
            $table->timestamps();

            // Link back to the users table
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_installments');
    }
};
