<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAniosTable extends Migration
{
    public function up()
    {
        Schema::create('anios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('anio')->unique();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anios');
    }
}
