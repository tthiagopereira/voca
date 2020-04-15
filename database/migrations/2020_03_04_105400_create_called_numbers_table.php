<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalledNumbersTable extends Migration
{
    public function up()
    {
        Schema::create('called_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->unsigned();
            $table->string('where');
            $table->string('color_line')->nullable();
            $table->string('guiche')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('called_numbers');
    }
}
