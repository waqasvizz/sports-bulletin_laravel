<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title', 100);
            $table->string('url', 100);
            $table->string('slug', 100);
            $table->integer('sort_order');
            $table->string('status', 50)->default('Draft');
            $table->string('asset_type', 40)->default('Icon');
            $table->string('asset_value')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('sub_menus');
    }
}
