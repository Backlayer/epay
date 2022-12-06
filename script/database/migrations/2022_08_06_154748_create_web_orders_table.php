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
        Schema::create('web_orders', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('website_id')->nullable()->constrained('websites')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->foreignId('gateway_id')->nullable()->constrained('gateways')->nullOnDelete();

            $table->string('trx')->nullable(); //payment id
            $table->string('reference_code')->nullable();
            $table->double('amount')->nullable();
            $table->double('charge')->nullable();
            $table->double('rate')->nullable();
            $table->integer('quantity')->nullable();
            $table->json('meta');
            $table->timestamp('paid_at', 0)->nullable();
            $table->integer('payment_status')->nullable(); //1=paid 0=faild
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_orders');
    }
};
