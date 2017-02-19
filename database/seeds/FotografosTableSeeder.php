<?php

use Illuminate\Database\Seeder;

class FotografosTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('fotografos')->delete();
        $regs = array(
            [
                'id' => 1,
                'nombre' => '',
                'email' => '',
                'telefono' => '',
                'biografia' => '',
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('fotografos')->insert($reg);
        }
    }

}
