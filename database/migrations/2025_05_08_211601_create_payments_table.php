<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Temporarily drop the FK constraint—just store the invoice ID for now
            $table->unsignedBigInteger('invoice_id')->nullable();

            $table->date('date');
            $table->decimal('amount', 15, 2);
            $table->string('method');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
