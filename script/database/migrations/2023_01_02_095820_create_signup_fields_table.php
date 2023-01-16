<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signup_fields', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('type');
            $table->integer('order')->default(0);
            $table->json('data')->nullable()->comment('Used for select, radio or checkbox fields');
            $table->boolean('isRequired')->default(false);
            $table->boolean('isActive')->default(false);

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
        Schema::dropIfExists('signup_fields');
    }
};