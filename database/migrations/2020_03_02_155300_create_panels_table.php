<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanelsTable extends Migration
{
    public function up()
    {
        Schema::create('panels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identification');
            $table->ipAddress('ip');
            $table->string('chama_pa')->nullable();
            $table->string('chama_pis')->nullable();
            $table->string('chama_pe')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('panels');
    }
}
