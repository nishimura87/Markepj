<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddresseesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addressees', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->char('postcode');
            $table->string('address');
            $table->string('building')->nullable();
            $table->timestamps();
            $table->string('phone_number',20);
            $table->string('name');
            $table->string('kana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addressees');
    }
}
