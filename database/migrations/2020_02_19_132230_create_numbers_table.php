<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumbersTable extends Migration
{
    public function up()
    {
        Schema::create('numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->unsigned();
            $table->boolean('pis')->default(false);
            $table->string('status_pis')->nullable();
            $table->boolean('pe')->default(false);
            $table->string('status_pe')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('numbers');
    }
}
