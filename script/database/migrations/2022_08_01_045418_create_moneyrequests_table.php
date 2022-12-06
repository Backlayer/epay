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
        Schema::create('moneyrequests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('receiver_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('request_currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->foreignId('approved_currency_id')->nullable()->constrained('currencies')->nullOnDelete();

            $table->double('amount')->nullable();
            $table->double('charge')->nullable();
            $table->double('rate')->nullable()->default(1);

            $table->integer('status')->default(2); //2 = pending 1 = approved 0 = cancelled
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
        Schema::dropIfExists('moneyrequests');
    }
};
