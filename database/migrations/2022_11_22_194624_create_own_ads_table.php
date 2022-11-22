<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('own_ads', function (Blueprint $table) {
            $table->id();
            $table->string('own_ad_title')->nullable();
            $table->string('own_ad_slug')->nullable();
            $table->enum('own_ad_status', ['Draft', 'Published']);
            $table->string('own_ad_image')->nullable();
            $table->longText('own_ad_description')->nullable();
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
        Schema::dropIfExists('own_ads');
    }
}
