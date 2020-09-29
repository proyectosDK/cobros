<?php

use App\Serie;
use Illuminate\Database\Seeder;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Serie();
        $data->serie = "A";
        $data->inicio=0;
        $data->no_actual = 0;
        $data->total = 2000;
       	$data->save();
    }
}
