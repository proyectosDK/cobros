<?php

use App\Mes;
use Illuminate\Database\Seeder;

class MesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $meses=["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"];

       for ($i=0; $i < 12; $i++) { 
       	$data = new Mes();
       	$data->mes = $meses[$i];
       	$data->save();
       }
       
    }
}
