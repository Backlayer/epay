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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('currency_id')->constrained()->cascadeOnDelete();
            $table->string('email');
            $table->double('amount');
            $table->string('trx')->nullable();
            $table->double('charge')->nullable();
            $table->double('rate')->nullable()->default(1);
            $table->boolean('is_beneficiary')->nullable(); // 0 = No, 1 = Yes
            $table->integer('status')->default(1); // 0 = Desclined, 1 = Pending, 2 = Approved, 3 = Refund
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
        Schema::dropIfExists('transfers');
    }
};
