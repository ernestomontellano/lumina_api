<?php

use Illuminate\Database\Seeder;

class SoportesTableSeeder extends Seeder
{

    public function run()
    {
        date_default_timezone_set('America/La_Paz');
        $fechahora = date('Y-m-d H:m:s');
        DB::table('soportes')->delete();
        $regs = array(
            [
                'id' => 1,
                'soporte' => '',
                'created_at' => $fechahora,
                'updated_at' => $fechahora
            ]
        );
        foreach ($regs as $reg) {
            DB::table('soportes')->insert($reg);
        }
    }

}
