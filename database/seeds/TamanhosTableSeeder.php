<?php

use Illuminate\Database\Seeder;

class TamanhosTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('tamanhos')->delete();
        $regs = array(
            [
                'id' => 1,
                'tamanho' => '40 x 30m',
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ],
            [
                'id' => 2,
                'tamanho' => '70 x 50m',
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('tamanhos')->insert($reg);
        }
    }

}
