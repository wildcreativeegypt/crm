<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ad_expenses', function (Blueprint $table) {
            $table->foreignId('client_id')
                  ->nullable()
                  ->after('ad_account_id')
                  ->constrained()
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('ad_expenses', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');
        });
    }
};
