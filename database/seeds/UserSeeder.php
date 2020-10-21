<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
   public function run()
    {
       $data = new User();
       $data->email = 'admin@admin.com';
       $data->password = bcrypt('admin123');
       $data->tipo_usuario_id = 1;
       $data->save();

       $data = new User();
       $data->email = 'receptor@receptor.com';
       $data->password = bcrypt('receptor123');
       $data->tipo_usuario_id = 2;
       $data->save();
    }
}
