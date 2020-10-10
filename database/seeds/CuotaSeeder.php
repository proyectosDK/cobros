<?php

use App\Cuota;
use Illuminate\Database\Seeder;

class CuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.

     *
     * @return void
     */
    public function run()
    {
        $data = new Cuota();
        $data->cuota = 250;
        $data->limite=30000;
        $data->extra = 2.5;
       	$data->save();
    }
}
