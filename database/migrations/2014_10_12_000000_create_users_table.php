<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->unsignedBigInteger('role');
            $table->foreign('role')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('phone_number')->nullable();
            // $table->enum('user_status', ['Active', 'Block'])->default('Active');
            $table->tinyInteger('user_status')->comment('1=Active, 2=Block')->default(1);
            $table->timestamp('last_seen')->nullable();
            $table->double('time_spent')->default(0);
            $table->enum('theme_mode', ['Light', 'Dark'])->default('Light');

            $table->rememberToken();
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
}