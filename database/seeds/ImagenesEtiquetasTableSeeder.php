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
                'imagenes_id' => 1,
                'etiquetas_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 2,
                'imagenes_id' => 2,
                'etiquetas_id' => 2,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 3,
                'imagenes_id' => 3,
                'etiquetas_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 4,
                'imagenes_id' => 4,
                'etiquetas_id' => 2,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 5,
                'imagenes_id' => 5,
                'etiquetas_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 6,
                'imagenes_id' => 6,
                'etiquetas_id' => 2,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 7,
                'imagenes_id' => 7,
                'etiquetas_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 8,
                'imagenes_id' => 8,
                'etiquetas_id' => 2,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 9,
                'imagenes_id' => 9,
                'etiquetas_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 10,
                'imagenes_id' => 10,
                'etiquetas_id' => 2,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 11,
                'imagenes_id' => 11,
                'etiquetas_id' => 1,
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('imagenesetiquetas')->insert($reg);
        }
    }

}
