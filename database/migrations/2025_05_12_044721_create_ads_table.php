<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('facebook_account_id')->unsigned();
            $table->string('page_name');
            $table->decimal('spend_amount', 10, 2);
            $table->decimal('tax_rate', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ads');
    }
}