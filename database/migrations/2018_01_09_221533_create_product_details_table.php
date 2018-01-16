<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('product_id')->index()->unsigned();
          $table->integer('menu_id')->index()->unsigned();
          $table->integer('product_color_id')->index()->unsigned()->nullable();
          $table->integer('product_material_id')->index()->unsigned()->nullable();
          $table->integer('product_size_id')->index()->unsigned()->nullable();
          $table->decimal('price')->unsigned();
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
        Schema::dropIfExists('product_details');
    }
}
