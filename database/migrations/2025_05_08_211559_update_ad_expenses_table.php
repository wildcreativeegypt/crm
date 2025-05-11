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
        Schema::table('ad_expenses', function (Blueprint $table) {
            // Link to the ad account (nullable, cascade on delete)
            $table->foreignId('ad_account_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Credit-card fee rate & computed fee amount
            $table->decimal('credit_card_fee_rate', 5, 4)->default(0.05);
            $table->decimal('credit_card_fee_amount', 15, 2)->default(0.00);

            // Currency (default EGP)
            $table->string('currency', 3)->default('EGP');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_expenses', function (Blueprint $table) {
            // Drop FK then columns
            $table->dropForeign(['ad_account_id']);
            $table->dropColumn([
                'ad_account_id',
                'credit_card_fee_rate',
                'credit_card_fee_amount',
                'currency',
            ]);
        });
    }
};
