<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ad_expenses', function (Blueprint $table) {
            // Check if the column already exists before trying to add it
            if (!Schema::hasColumn('ad_expenses', 'client_id')) {
                $table->unsignedBigInteger('client_id')->nullable()->after('ad_account_id');
            }

            // Add the foreign key constraint if it doesn't already exist
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ad_expenses', function (Blueprint $table) {
            // Drop the foreign key constraint if it exists
            $table->dropForeign(['client_id']);

            // Drop the column if it exists
            if (Schema::hasColumn('ad_expenses', 'client_id')) {
                $table->dropColumn('client_id');
            }
        });
    }
};