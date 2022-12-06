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
        Schema::create('singlechargeorders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->string('trx')->nullable();
            $table->double('amount')->nullable();
            $table->double('charge')->nullable();
            $table->integer('rate')->nullable();

            $table->string('name')->nullable();
            $table->string('email')->nullable();

            $table->integer('status')->default(1); //1=complete 0= failed
            $table->foreignId('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->foreignId('gateway_id')
                    ->references('id')
                    ->on('gateways')
                    ->onDelete('cascade');
            $table->foreignId('singlecharge_id')
                    ->references('id')
                    ->on('singlecharges')
                    ->onDelete('cascade');
            $table->foreignId('currency_id')
                    ->references('id')
                    ->on('currencies')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('singlechargeorders');
    }
};
