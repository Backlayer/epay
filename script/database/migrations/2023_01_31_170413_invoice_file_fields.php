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
        Schema::table('invoices', function ($table) {
            $table->string('invoice_file')->nullable()->after('data');
        });
        Schema::table('singlechargeorders', function ($table) {
            $table->string('invoice_file')->nullable()->after('data');
        });
        Schema::table('qrpayments', function ($table) {
            $table->string('invoice_file')->nullable()->after('data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function ($table) {
            $table->dropColumn('invoice_file');
        });
        Schema::table('singlechargeorders', function ($table) {
            $table->dropColumn('invoice_file');
        });
        Schema::table('qrpayments', function ($table) {
            $table->dropColumn('invoice_file');
        });
    }
};
