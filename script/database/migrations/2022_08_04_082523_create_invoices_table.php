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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('invoice_no')->nullable();
            $table->string('trx')->nullable();
            $table->double('charge')->nullable();
            $table->double('rate')->nullable();
            $table->double('tax')->nullable();
            $table->double('discount')->nullable();
            $table->double('total')->nullable();
            $table->string('customer_email')->nullable();
            $table->date('due_date')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_sent')->default(false);

            //Sender Information
            $table->string('name')->nullable();
            $table->string('email')->nullable();

            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
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
        Schema::dropIfExists('invoices');
    }
};
