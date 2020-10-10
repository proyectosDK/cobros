<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCobrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('serie_id');
            $table->unsignedBigInteger('cuota_id');
            $table->integer('numero');
            $table->date('fecha');
            $table->decimal('total',11,2);
            $table->boolean('anulado')->default(false);
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('cascade');
            $table->foreign('serie_id')->references('id')->on('series')->onUpdate('cascade');
            $table->foreign('cuota_id')->references('id')->on('cuotas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cobros');
    }
}
