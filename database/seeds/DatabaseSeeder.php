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
        $this->call(SoportesTableSeeder::class);
        $this->call(FotografosTableSeeder::class);
        $this->call(ImagenesTableSeeder::class);
        $this->call(TamanhosTableSeeder::class);
        $this->call(EtiquetasTableSeeder::class);
        $this->call(ImagenesTamanhosTableSeeder::class);
        $this->call(ImagenesEtiquetasTableSeeder::class);
        Model::reguard();
    }

}
