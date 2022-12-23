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
            $table->json('fields')->nullable()->after('currency_id');
            $table->json('data')->nullable()->after('fields');
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
            $table->dropColumn('fields');
            $table->dropColumn('data');
        });
    }
};
