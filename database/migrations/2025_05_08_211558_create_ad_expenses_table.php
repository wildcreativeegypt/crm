<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ad_expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campaign_id');      // link later to campaigns
            $table->date('date');
            $table->decimal('amount', 15, 2);
            $table->string('receipt_path')->nullable();
            $table->boolean('reimbursed')->default(false);
            $table->boolean('invoiced')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ad_expenses');
    }
};
