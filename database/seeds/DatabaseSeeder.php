<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(TipoUsuarioSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MesSeeder::class);
        $this->call(CuotaSeeder::class);
        $this->call(UbicacionSeeder::class);
        $this->call(AnioSeeder::class);
        $this->call(SerieSeeder::class);
        $this->call(ClienteSeeder::class);
    }
}
