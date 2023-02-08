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
        Schema::table('qrpayments', function ($table) {
            $table->enum('status_paid', ['2', '1', '0'])->default('0')->comment('0: Pending, 1: Payout, 2: Confirmed')->after('paid_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qrpayments', function ($table) {
            $table->dropColumn('status_paid');
        });
    }
};
