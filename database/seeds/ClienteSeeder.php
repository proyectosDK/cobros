<?php

use App\Mes;
use App\Cobro;
use App\Cliente;
use App\DetallesCobro;
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
        $meses = Mes::all();
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

            $cobro = new Cobro;
            $cobro->numero = $i;
            $cobro->cliente_id = $data->id;
            $cobro->total = 0;
            $cobro->serie_id = 1;
            $cobro->cuota_id = 1;
            $cobro->fecha = '2019-01-12';
            $cobro->save();

            foreach ($meses as $mes) {
                $detalle = new DetallesCobro;
                $detalle->cobro_id = $cobro->id;
                $detalle->mes_id = $mes->id;
                $detalle->anio_id = 1;
                $detalle->lectura = rand(1000,31500);
                $detalle->agua_extra = 0;
                $detalle->total_extra = 0;
                if($detalle->lectura > 30000){
                    $detalle->agua_extra = $detalle->lectura - 30000;
                    $detalle->total_extra = $detalle->agua_extra * 2.5;
                }
                
                $detalle->total_mes = 250 + $detalle->total_extra;
                $detalle->save();
                $cobro->total+=$detalle->total_mes;
            }

            $cobro->save();

            $cobro = new Cobro;
            $cobro->numero = 100+$i;
            $cobro->cliente_id = $data->id;
            $cobro->total = 0;
            $cobro->serie_id = 1;
            $cobro->cuota_id = 1;
            $cobro->fecha = '2020-01-09';
            $cobro->save();

            foreach ($meses as $mes) {
                $detalle = new DetallesCobro;
                $detalle->cobro_id = $cobro->id;
                $detalle->mes_id = $mes->id;
                $detalle->anio_id = 2;
                $detalle->lectura = rand(1000,31500);
                $detalle->agua_extra = 0;
                $detalle->total_extra = 0;

                if($detalle->lectura > 30000){
                    $detalle->agua_extra = $detalle->lectura - 30000;
                    $detalle->total_extra = $detalle->agua_extra * 2.5;
                }
                $detalle->total_mes = 250 + $detalle->total_extra;
                $detalle->save();
                $cobro->total+=$detalle->total_mes;

                if($mes->id > 8){
                    break;
                }
            }

            $cobro->total+=$detalle->total_mes;
            $cobro->save();
        }
    }
}
