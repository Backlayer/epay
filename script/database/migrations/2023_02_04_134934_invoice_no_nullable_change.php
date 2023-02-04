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
        Schema::table('singlechargeorders', function ($table) {
            $table->string('invoice_no')->nullable()->change();
        });
        Schema::table('donationorders', function ($table) {
            $table->string('invoice_no')->nullable()->change();
        });
        Schema::table('orders', function ($table) {
            $table->string('invoice_no')->nullable()->change();
        });
        Schema::table('qrpayments', function ($table) {
            $table->string('invoice_no')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('singlechargeorders', function ($table) {
            $table->string('invoice_no')->change();
        });
        Schema::table('donationorders', function ($table) {
            $table->string('invoice_no')->change();
        });
        Schema::table('orders', function ($table) {
            $table->string('invoice_no')->change();
        });
        Schema::table('qrpayments', function ($table) {
            $table->string('invoice_no')->change();
        });
    }
};
