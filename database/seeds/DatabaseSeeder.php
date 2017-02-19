<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();
        $this->call(UsuariosTableSeeder::class);
        $this->call(ContenidosTableSeeder::class);
        Model::reguard();
    }

}
