<?php

use App\Anio;
use Illuminate\Database\Seeder;

class AnioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Anio();
        $data->anio = 2020;
       	$data->save();
    }
}
