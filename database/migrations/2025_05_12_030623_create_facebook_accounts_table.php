<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacebookAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('facebook_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the Facebook account
            $table->string('account_id')->unique(); // Facebook account identifier
            $table->decimal('current_balance', 10, 2)->default(0); // Balance
            $table->timestamps(); // Timestamps for creation and updates
        });
    }

    public function down()
    {
        Schema::dropIfExists('facebook_accounts');
    }
}
