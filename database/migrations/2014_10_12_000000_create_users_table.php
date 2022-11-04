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
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('full_name', 100)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('user_type', ['super-club', 'chef-at-home', 'both', 'none'])->default('none');
            $table->string('dob', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();
            $table->string('profile_image')->nullable();
            $table->string('phone_number')->nullable();
            $table->tinyInteger('user_status')->comment('1=Active, 2=Block')->default(1);
            $table->enum('register_from', ['app', 'facebook', 'gmail', 'apple'])->default('app');
            $table->timestamp('last_seen')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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