<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRescheduledDateToInstallmentPlansTable extends Migration
{
    public function up()
    {
        Schema::table('installment_plans', function (Blueprint $table) {
            $table->date('rescheduled_date')->nullable()->after('start_date');
        });
    }

    public function down()
    {
        Schema::table('installment_plans', function (Blueprint $table) {
            $table->dropColumn('rescheduled_date');
        });
    }
}