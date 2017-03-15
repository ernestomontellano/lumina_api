<?php

use Illuminate\Database\Seeder;

class EtiquetasTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('etiquetas')->delete();
        $regs = array(
            [
                'id' => 1,
                'etiqueta' => 'paisaje',
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 2,
                'etiqueta' => 'retrato',
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('etiquetas')->insert($reg);
        }
    }

}
