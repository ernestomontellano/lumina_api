<?php

use Illuminate\Database\Seeder;

class ImagenesTamanhosTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('imagenestamanhos')->delete();
        $regs = array(
            [
                'id' => 1,
                'imagenes_id' => 0,
                'tamanhos_id' => 0,
                'preciobs' => '',
                'preciosus' => '',
                'disponible' => 0,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('imagenestamanhos')->insert($reg);
        }
    }

}
