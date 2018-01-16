<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_detail_id')->index()->unsigned();
            $table->integer('menu_id')->index()->unsigned();
            $table->string('media_1');
            $table->string('media_2')->nullable();
            $table->string('media_3')->nullable();
            $table->string('media_4')->nullable();
            $table->string('media_5')->nullable();
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
        Schema::dropIfExists('product_media');
    }
}
