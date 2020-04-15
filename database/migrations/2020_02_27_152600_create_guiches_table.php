<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuichesTable extends Migration
{
    public function up()
    {
        Schema::create('guiches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identification');
            $table->ipAddress('ip');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guiches');
    }
}
