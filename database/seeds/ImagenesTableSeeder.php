<?php

use Illuminate\Database\Seeder;

class ImagenesTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('imagenes')->delete();
        $regs = array(
            [
                'id' => 1,
                'nombre' => '',
                'codigo' => '',
                'imagen' => '',
                'descripcion' => '',
                'fotografos_id' => 0,
                'soportes_id' => 0,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('imagenes')->insert($reg);
        }
    }

}
