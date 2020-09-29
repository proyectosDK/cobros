<?php

use App\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.

     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100 ; $i++) { 
        	$data = new Cliente;
        	$data->cui = '123456789011 '.$i;
        	$data->nit = '123456'.$i;
        	$data->primer_nombre="nombre cliente ".$i;
        	$data->primer_apellido="apellido cliente ".$i;
        	$data->genero = "M";
        	$data->fecha_nac="1990-12-01";
        	$data->fecha_inicio="2020-01-01";
        	$data->ubicacion_id=rand(1,2);
        	$data->save();
        }
    }
}
