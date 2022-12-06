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
        Schema::create('storefronts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('status')->default(1); // 1. Active, 0 = Deactivate
            $table->boolean('product_type')->nullable(); // 0 Physical, 1 = Digital
            $table->boolean('shipping_status')->default(1); // 1. Active, 0 = Deactivate
            $table->integer('note_status')->default(1); // 1 = Required, 0 = Disabled, 2 = Optional
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
        Schema::dropIfExists('storefronts');
    }
};
