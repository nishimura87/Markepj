<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('title');
            $table->integer('price');
            $table->string('color');
            $table->string('size');
            $table->integer('quantity');
            $table->integer('part_number');
            $table->text('info');
            $table->string('material');
            $table->string('img_path1');
            $table->string('img_path2')->nullable();
            $table->string('img_path3')->nullable();
            $table->string('img_path4')->nullable();
            $table->string('img_path5')->nullable();
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
        Schema::dropIfExists('items');
    }
}
