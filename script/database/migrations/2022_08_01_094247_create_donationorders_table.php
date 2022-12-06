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
        Schema::create('donationorders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->string('trx')->nullable();
            $table->double('amount')->nullable();
            $table->double('charge')->nullable();
            $table->double('rate')->nullable();
            $table->integer('is_anonymous')->default(0);
            $table->text('data')->nullable();//
            $table->integer('status')->default(1); //1=complete 0= failed

            $table->string('name')->nullable();
            $table->string('email')->nullable();

            $table->foreignId('donor_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreignId('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->foreignId('gateway_id')
                    ->references('id')
                    ->on('gateways')
                    ->onDelete('cascade');
            $table->foreignId('currency_id')
                    ->references('id')
                    ->on('currencies')
                    ->onDelete('cascade');
            $table->foreignId('donation_id')
                    ->references('id')
                    ->on('donations')
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
        Schema::dropIfExists('donationorders');
    }
};
