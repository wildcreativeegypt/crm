<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundsTable extends Migration
{
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facebook_account_id'); // Foreign key to Facebook account
            $table->foreign('facebook_account_id')->references('id')->on('facebook_accounts')->onDelete('cascade');
            $table->decimal('amount', 10, 2); // Amount added
            $table->decimal('tax_inclusive', 10, 2); // Amount including tax
            $table->decimal('tax_exclusive', 10, 2); // Amount excluding tax
            $table->decimal('tax', 10, 2); // Tax amount
            $table->timestamps(); // Timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('funds');
    }
}
