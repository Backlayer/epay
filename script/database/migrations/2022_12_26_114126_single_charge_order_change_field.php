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
            $table->dropColumn('status');

            $table->timestamp('paid_at')->nullable()->after('email');
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
        Schema::table('singlechargeorders', function ($table) {
            $table->integer('status')->default(1)->after('email');
            $table->dropColumn('paid_at');
            $table->dropColumn('status_paid');
        });
    }
};
