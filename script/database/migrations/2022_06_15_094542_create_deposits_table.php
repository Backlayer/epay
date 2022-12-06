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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('gateway_id')->constrained('gateways');
            $table->foreignId('currency_id')->constrained('currencies');
            $table->string('trx')->nullable();
            $table->double('amount')->nullable();
            $table->double('total_amount')->nullable();
            $table->integer('status')->nullable(); // 1 = Completed, 2 = Pending, 0 = Rejected
            $table->integer('payment_status')->nullable();
            $table->double('charge')->nullable();
            $table->double('rate')->nullable();
            $table->json('meta')->nullable();
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
        Schema::dropIfExists('deposits');
    }
};
