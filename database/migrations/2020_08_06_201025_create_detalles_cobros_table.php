<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesCobrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_cobros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cobro_id');
            $table->unsignedBigInteger('anio_id');
            $table->unsignedBigInteger('mes_id');
            $table->decimal('lectura',10,2);
            $table->decimal('agua_extra',10,2);
            $table->decimal('total_extra',11,2);
            $table->decimal('total_mes',11,2);
            $table->timestamps();

            $table->foreign('cobro_id')->references('id')->on('cobros')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('anio_id')->references('id')->on('anios')->onUpdate('cascade');
            $table->foreign('mes_id')->references('id')->on('mes')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_cobros');
    }
}
