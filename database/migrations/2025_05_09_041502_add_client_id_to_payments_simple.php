<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Only add if it doesn't already exist
            if (! Schema::hasColumn('payments', 'client_id')) {
                $table->unsignedBigInteger('client_id')->nullable()->after('invoice_id');
            }
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'client_id')) {
                $table->dropColumn('client_id');
            }
        });
    }
};
