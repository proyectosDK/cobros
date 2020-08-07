<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ubicacion_id');
            $table->integer('cui');
            $table->integer('nit')->nullable();
            $table->string('primer_nombre',25);
            $table->string('segundo_nombre',25)->nullable();
            $table->string('primer_apellido',25);
            $table->string('segundo_apellido',25)->nullable();
            $table->char('genero',1);
            $table->date('fecha_nac')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->string('ubicacion',255)->nullable();
            $table->char('estado',1)->default('A');
            $table->boolean('deudor')->default(0);
            $table->timestamps();

            $table->foreign('ubicacion_id')->references('id')->on('ubicacions')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
