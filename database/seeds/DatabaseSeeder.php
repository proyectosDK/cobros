<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(TipoUsuarioSeeder::class);
        $this->call(UserSeeder::class);
    }
}
