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
        Schema::table('payments', function (Blueprint $table) {
            // Company tax rate applied to the payment
            $table->decimal('company_tax_rate', 5, 4)->nullable();

            // Computed tax amount withheld
            $table->decimal('company_tax_amount', 15, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop the tax columns
            $table->dropColumn(['company_tax_rate', 'company_tax_amount']);
        });
    }
};
