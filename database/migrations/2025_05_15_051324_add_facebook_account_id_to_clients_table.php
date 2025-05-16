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
        Schema::table('clients', function (Blueprint $table) {
            // Add the foreign key column
            $table->unsignedBigInteger('facebook_account_id')->nullable();
            
            // Add the foreign key constraint
            $table->foreign('facebook_account_id')
                  ->references('id')
                  ->on('facebook_accounts')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['facebook_account_id']);
            
            // Then drop the column
            $table->dropColumn('facebook_account_id');
        });
    }
};