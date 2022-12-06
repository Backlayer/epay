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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('username')->unique();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->foreignId('currency_id')->nullable()->comment('use as country')->constrained()->nullOnDelete();

            $table->string('role')->default('user');
            $table->double('wallet')->default(0.00);
            $table->string('password')->nullable();
            $table->integer('status')->default(1); //1= active 2= paused 0 = suspend
            $table->json('meta')->nullable();
            $table->string('public_key')->unique();
            $table->string('secret_key')->unique();
            $table->string('qr')->unique();

            $table->ipAddress()->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('kyc_verified_at')->nullable();

            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');

    }
};
