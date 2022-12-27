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
            $table->dropColumn('is_paid');

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
        Schema::table('invoices', function ($table) {
            $table->boolean('is_paid')->default(false)->after('paid_at');
            $table->dropColumn('status_paid');
        });
    }
};
