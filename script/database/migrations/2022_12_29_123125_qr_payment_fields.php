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
            $table->json('fields')->nullable()->after('rate');
            $table->json('data')->nullable()->after('fields');
            $table->timestamp('paid_at')->nullable()->after('data');
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
            $table->dropColumn('fields');
            $table->dropColumn('data');
            $table->dropColumn('paid_at');
        });
    }
};
