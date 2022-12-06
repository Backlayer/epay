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
        Schema::create('qrpayments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('gateway_id')->nullable()->constrained('gateways')->cascadeOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->cascadeOnDelete();
            $table->string('trx')->nullable(); //payment id
            $table->double('amount')->nullable();
            $table->double('charge')->nullable();
            $table->double('rate')->default(1);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('qrpayments');
    }
};
