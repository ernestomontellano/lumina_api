<?php

use Illuminate\Database\Seeder;

class ImagenesEtiquetasTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('imagenesetiquetas')->delete();
        $regs = array(
            [
                'id' => 1,
                'imagenes_id' => 0,
                'etiquetas_id' => 0,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('imagenesetiquetas')->insert($reg);
        }
    }

}
